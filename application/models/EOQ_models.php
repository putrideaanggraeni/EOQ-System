<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eoq_models extends CI_Model {
	
	public function get($id = null)
	{
		$this->db->select('item.barcode, nama, harga_pembelian, stock, item.item_id, tanggal, SUM(qty) as jml, item.kriteria_id,biayapemesanan,biayapenyimpanan,dari,sampai,leadtime, 
		
		SQRT((2*SUM(qty)*biayapemesanan)/(harga_pembelian*biayapenyimpanan/100)) as eoq,
		
		(SUM(qty)) / (SQRT((2*SUM(qty)*biayapemesanan)/(harga_pembelian*biayapenyimpanan/100))) as F,
		
		30/((SUM(qty)) / (SQRT((2*SUM(qty)*biayapemesanan)/(harga_pembelian*biayapenyimpanan/100)))) as t,
		
		((SQRT((2*SUM(qty)*biayapemesanan)/(harga_pembelian*biayapenyimpanan/100)) / (30/((SUM(qty)) / (SQRT((2*SUM(qty)*biayapemesanan)/(harga_pembelian*biayapenyimpanan/100))))))) as d,
		
		SQRT(leadtime) as lt,
		
		(SUM(qty))^2 as std,
		
		count(qty) as c

		');
		$this->db->from('item');
		$this->db->join('detail_transaksi', 'item.item_id = detail_transaksi.item_id');
		$this->db->join('kriteria', 'item.kriteria_id = kriteria.kriteria_id');
		if($id != null) {
			$this->db->where('item_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	
	public function getBrgTerjual()
	{
		$day = date("d");
		$this->db->where('tanggal >= dari');
		$this->db->where('tanggal <= sampai');
		
		$this->db->select('item.barcode, nama, harga_pembelian, stock, status, item.item_id, tanggal, SUM(qty) as jml, item.kriteria_id,biayapemesanan,biayapenyimpanan,dari,sampai,leadtime,
		
		MAX(qty) as pmax,
		
		SQRT(leadtime) as lt,
		
		count(qty) as c,
		
		(SUM(qty)*SUM(qty)) as y,
		
		SUM(qty*qty) as yy ,
		
		sum(qty*qty) as n,
		
		SQRT((2*SUM(qty)*biayapemesanan)/(harga_pembelian*biayapenyimpanan/100)) as eoq	
		
		');
		
		$this->db->from('item');
		$this->db->join('total_kebutuhan', 'item.item_id = total_kebutuhan.item_id');
		$this->db->join('kriteria', 'item.kriteria_id = kriteria.kriteria_id');
		$this->db->group_by('item_id','desc');
		return $this->db->get();
	}


	function getbg()
	{
		$query = "SELECT DISTINCT item.barcode, nama, harga_pembelian, stock, item.item_id, tanggal, SUM(qty) as jml, item.kriteria_id,biayapemesanan,biayapenyimpanan,dari,sampai,leadtime, 
		
		MAX(qty) as pmax,
		
		(SUM(qty)*SUM(qty)) as y,
		
		(SUM(qty))*(SUM(qty)) as yy ,
		
		SQRT((2*SUM(qty)*biayapemesanan)/(harga_pembelian*biayapenyimpanan/100)) as eoq
		
		FROM item JOIN detail_transaksi ON item.item_id = detail_transaksi.item_id JOIN kriteria ON item.kriteria_id = kriteria.kriteria_id 
		
		WHERE tanggal > dari < sampai
		
		GROUP BY 
		item_id
	
		ORDER BY item_id

		";
		
		return $this->db->query($query);
	}	
	

	function getBrgPerBulan()
	{
		$tahun = date("m");
		$query = "SELECT item.barcode, nama, harga_pembelian, stock, item.item_id, tanggal, SUM(qty) as jml FROM item JOIN detail_transaksi ON item.item_id = detail_transaksi.item_id 
		WHERE MONTH(tanggal) = '$tahun'
		GROUP BY item_id";
		
		return $this->db->query($query);
	}	
	
	
	function getBrg()
	{
		$bulan = date("m");
		$query = "SELECT item.barcode, nama, harga_pembelian, stock, item.item_id, tanggal, SUM(qty) as jml, item.kriteria_id,biayapemesanan,biayapenyimpanan,dari,sampai,leadtime, 
		
		SQRT((2*SUM(qty)*biayapemesanan)/(harga_pembelian*biayapenyimpanan/100)) as eoq,
		
		(SUM(qty)) / (SQRT((2*SUM(qty)*biayapemesanan)/(harga_pembelian*biayapenyimpanan/100))) as F,
		
		30/((SUM(qty)) / (SQRT((2*SUM(qty)*biayapemesanan)/(harga_pembelian*biayapenyimpanan/100)))) as t,
		
		((SQRT((2*SUM(qty)*biayapemesanan)/(harga_pembelian*biayapenyimpanan/100)) / (30/((SUM(qty)) / (SQRT((2*SUM(qty)*biayapemesanan)/(harga_pembelian*biayapenyimpanan/100))))))) as d,
		
		((SQRT((2*SUM(qty)*biayapemesanan)/(harga_pembelian*biayapenyimpanan/100)) / (30/((SUM(qty)) / (SQRT((2*SUM(qty)*biayapemesanan)/(harga_pembelian*biayapenyimpanan/100)))))))*leadtime as ss,
		
		2*(((SQRT((2*SUM(qty)*biayapemesanan)/(harga_pembelian*biayapenyimpanan/100)) / (30/((SUM(qty)) / (SQRT((2*SUM(qty)*biayapemesanan)/(harga_pembelian*biayapenyimpanan/100)))))))*leadtime) as rop 
		
		SQRT(leadtime) as lt,
		
		COUNT(qty) as c,
		
		FROM item JOIN detail_transaksi ON item.item_id = detail_transaksi.item_id JOIN kriteria ON item.kriteria_id = kriteria.kriteria_id WHERE 
		MONTH(tanggal) = '$bulan' GROUP BY item_id";
		
		return $this->db->query($query);
	}	
	
	function getrop()
	{
		$query = "SELECT item.barcode, nama, harga_pembelian, stock, item.item_id, SUM(qty) as jml, 
		item.kriteria_id,biayapemesanan,biayapenyimpanan,leadtime, 
		leadtime*SQRT((2*SUM(qty)*biayapemesanan)/(harga_pembelian*biayapenyimpanan/100))/30 as rop
		FROM item JOIN detail_transaksi ON item.item_id = detail_transaksi.item_id JOIN kriteria ON item.kriteria_id = kriteria.kriteria_id GROUP BY item_id";
		return $this->db->query($query);
	}
	
	
	public function edit($post)
	{
		$para = [
			'dari' => $post['dari'],
			'sampai' => $post['sampai'],
			'biayapemesanan' => $post['biayapemesanan'],
			'biayapenyimpanan' => $post['biayapenyimpanan'],
			'leadtime' => $post['leadtime']
		];
		$this->db->where('kriteria_id', $post['kriteria_id']);
		$this->db->update('kriteria', $para);
	}
	
	public function pesan($post)
	{
		$status = 'Dalam Pemesanan';
		$para = [
			'status' => $status,
		];
		$this->db->where('item_id', $post['item_id']);
		$this->db->update('item', $para);
	}
	
	public function batalkan($post)
	{
		$status = '';
		$para = [
			'status' => $status,
		];
		$this->db->where('item_id', $post['item_id']);
		$this->db->update('item', $para);
	}
	
}	