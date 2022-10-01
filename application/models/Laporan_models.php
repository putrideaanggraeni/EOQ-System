<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_models extends CI_Model {
	
	public function get($id = null)
	{
		$this->db->select('transaksi.no_faktur, tanggal, user.user_id as user_id, user.nama as user_name,customer.customer_id as customer_id,customer.nama as customer_name, metode_pembayaran, discount, total_bersih');
		$this->db->from('transaksi');
		$this->db->join('customer', 'transaksi.customer_id =customer.customer_id');
		$this->db->join('user', 'transaksi.user_id = user.user_id');
		if($id != null) {
			$this->db->where('no_faktur', $id);
		}
		return $this->db->get();
	}
	
	public function getDetail($id = null)
	{
	$this->db->select('detail_transaksi.no_faktur,tanggal, qty, item.barcode as barcode, item.item_id as item_id, item.nama as nama, item.harga_penjualan harga_penjualan, (item.harga_penjualan*qty) as total');
		$this->db->from('detail_transaksi');
		$this->db->join('item', 'detail_transaksi.item_id = item.item_id');
		if($id !=null) {
			$this->db->where('no_faktur', $id);
		}
		$query = $this->db->get();
		return $query;
	}	
	
	
	public function getPenjualan($dari,$sampai)
	{
		$this->db->where('tanggal >=', $dari);
		$this->db->where('tanggal <=', $sampai);
		
		$this->db->select('transaksi.no_faktur, tanggal, user.user_id as user_id, user.nama as user_name,customer.customer_id as customer_id,customer.nama as customer_name, metode_pembayaran, total_bersih');
		$this->db->from('transaksi');
		$this->db->join('customer', 'transaksi.customer_id =customer.customer_id');
		$this->db->join('user', 'transaksi.user_id = user.user_id');
		return $this->db->get();
	}
	
	public function del($id) 
	{
		$this->db->where('no_faktur', $id);
		$this->db->delete('transaksi');
	}
	
	function getLaporanPenjualan($dari,$sampai)
	{
		$this->db->where('tanggal >=', $dari);
		$this->db->where('tanggal <=', $sampai);
		
		$this->db->select('transaksi.no_faktur, tanggal, user.user_id as user_id, user.nama as user_name,customer.customer_id as customer_id,customer.nama as customer_name, metode_pembayaran, total_bersih');
		$this->db->from('transaksi');
		$this->db->join('customer', 'transaksi.customer_id =customer.customer_id');
		$this->db->join('user', 'transaksi.user_id = user.user_id');
		return $this->db->get();
	}
}