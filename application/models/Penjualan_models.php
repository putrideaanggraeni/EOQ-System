<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_models extends CI_Model {
	
	public function get($id = null)
	{
		$this->db->select('total_kebutuhan.id, item.barcode as barcode, item.item_id as item_id, item.nama as item_name, item.harga_penjualan as harga_penjualan, qty, (item.harga_penjualan*qty) as total');
		$this->db->from('total_kebutuhan');
		$this->db->join('item', 'total_kebutuhan.item_id = item.item_id');
		if($id != null) {
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	
	function check_barang($code, $id = null)
	{
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