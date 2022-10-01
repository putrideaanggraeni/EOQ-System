<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_models extends CI_Model {
	
	function getLastFaktur($tahun,$bulan,$tanggal)
	{
		$this->db->select('no_faktur');
		$this->db->from('transaksi');
		$this->db->where('DAY(tanggal)', $tanggal);
		$this->db->where('MONTH(tanggal)', $bulan);
		$this->db->where('YEAR(tanggal)', $tahun);
		$this->db->order_by('no_faktur','desc');
		$this->db->limit(1);
		return $this->db->get();
	}
	
		public function get($id = null)
	{
		$this->db->select('keranjang_transaksi.id, item.barcode as barcode, item.item_id as item_id, item.nama as item_name, item.harga_penjualan as harga_penjualan, qty, (item.harga_penjualan*qty) as total, diskon.diskon as diskon');
		$this->db->from('keranjang_transaksi');
		$this->db->join('item', 'keranjang_transaksi.item_id = item.item_id');
		$this->db->join('diskon', 'keranjang_transaksi.diskon_id = diskon.diskon_id');
		if($id != null) {
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	
	public function getData($id = null)
	{
		$this->db->select('total_kebutuhan.id, item.barcode as barcode, item.item_id as item_id, item.nama as item_name, item.harga_penjualan as harga_penjualan, qty');
		$this->db->from('total_kebutuhan');
		$this->db->join('item', 'total_kebutuhan.item_id = item.item_id');
		if($id != null) {
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	
	public function getDiskon($id = null)
	{
		$this->db->select('diskon.diskon_id, diskon, ket_diskon');
		$this->db->from('diskon');
		if($id != null) {
			$this->db->where('diskon_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	
	public function del($id) 
	{
		$this->db->where('id', $id);
		$this->db->delete('keranjang_transaksi');
	}
	
	public function delDetail($id) 
	{
		$this->db->where('id', $id);
		$this->db->delete('detail_transaksi');
	}
	
	public function add($post)
	{
		$para = [
			'no_faktur' => $post['no_faktur'],
			'barcode' => $post['barcode'],
			'item_id' => $post['item_id'],
			'harga_penjualan' => $post['harga_penjualan'],
			'qty' => $post['qty'],
			'diskon_id' => $post['diskon_id']
		];
		
		$this->db->insert('keranjang_transaksi', $para);
	}
	
	function update($data)
	{
		$qty = $data['qty'];
		$code = $data['barcode'];
		$sql = "UPDATE keranjang_transaksi SET qty = qty + '$qty' WHERE barcode = '$code'";
		$this->db->query($sql);
	}
	
	public function simpanDetail($post)
	{
		$no_faktur = $this->input->post('no_faktur');
		$keranjang = $this->db->get_where('keranjang_transaksi', array('no_faktur' => $no_faktur));
		foreach($keranjang->result() as $d) {
			$para = [
			'no_faktur' => $d->no_faktur,
			'tanggal' => $post['tanggal'],
			'barcode' => $d->barcode,
			'item_id' => $d->item_id,
			'harga_penjualan' => $d->harga_penjualan,
			'qty' => $d->qty
		];	
		$this->db->insert('detail_transaksi', $para);
		}
		
	} 
	
	public function simpanData($post)
	{
		$keranjang = $this->db->get_where('keranjang_transaksi');
		foreach($keranjang->result() as $d) {
			$para = [
			'tanggal' => $post['tanggal'],
			'barcode' => $d->barcode,
			'item_id' => $d->item_id,
			'harga_penjualan' => $d->harga_penjualan,
			'qty' => $d->qty
			];	
		$this->db->insert('total_kebutuhan', $para);
		}
	} 
	
	
	function updateData($data, $post)
	{
		$keranjang = $this->db->get_where('keranjang_transaksi');
		foreach($keranjang->result() as $d) {
			$qty = $d->qty;
			$code = $d->barcode;
		
		$tgl = $data['tanggal'];
		$sql = "UPDATE total_kebutuhan SET qty = qty + '$qty' WHERE barcode = '$code' AND tanggal = '$tgl'";
		
		$this->db->query($sql);
		}
	}
	
	public function simpan($post)
	{
		$para = [
			'no_faktur' => $post['no_faktur'],
			'tanggal' => $post['tanggal'],
			'user_id' => $post['user_id'],
			'customer_id' => $post['customer_id'],
			'metode_pembayaran' => $post['metode_pembayaran'],
			'total_bersih' => $post['total_bersih'],
			'discount' => $post['discount']
		];
		$this->db->insert('transaksi', $para);
	}
	
	public function emp() 
	{
		$this->db->truncate('keranjang_transaksi');
	}
	
	public function getPenjualanPerBulan()
	{
		$tahun = date("Y");
		$query = "SELECT id, nama_bulan, totalpenjualan FROM bulan LEFT JOIN (SELECT MONTH(tanggal) as bulan, SUM(total_bersih) as totalpenjualan
		FROM transaksi
		WHERE YEAR(tanggal) = '$tahun'
		GROUP BY MONTH(tanggal)
		) pnj ON (bulan.id = pnj.bulan)";
		
		return $this->db->query($query);
	}
	
	public function getPendapatan()
	{
		$tahun = date("m");
		$query = "SELECT id, nama_bulan, totalpenjualan FROM bulan LEFT JOIN (SELECT MONTH(tanggal) as bulan, SUM(total_bersih) as totalpenjualan
		FROM transaksi
		WHERE MONTH(tanggal) = '$tahun'
		GROUP BY MONTH(tanggal)
		) pnj ON (bulan.id = pnj.bulan)";
		
		return $this->db->query($query);
	}
	
	function getNota($id = null)
	{		
		$this->db->select('keranjang_transaksi.id,barcode,nama,harga_penjualan,qty (harga_penjualan*qty)');
		$this->db->from('keranjang_transaksi');
		
		if($id !=null) {
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	
	function check_barcode($code, $id = null)
	{
		$this->db->from('keranjang_transaksi');
		$this->db->where('barcode', $code);
		if($id != null){
			$this->db->where('id!=', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	
	function check_barang($code, $id = null)
	{
		$keranjang = $this->db->get_where('keranjang_transaksi');
		foreach($keranjang->result() as $d) {
			$qty = $d->qty;
			$code = $d->barcode;
		}
		$this->db->from('total_kebutuhan');
		$this->db->where('barcode', $code);
		if($id != null){
			$this->db->where('id!=', $id);
		}

		$query = $this->db->get();
		return $query;
		
	}
	
	function check_tanggal($tgl , $id = null)
	{
		$this->db->from('total_kebutuhan');
		$this->db->where('tanggal', $tgl);
		if($id != null){
			$this->db->where('id!=', $id);
		}
	
		$query = $this->db->get();
		return $query;
	
	}

}