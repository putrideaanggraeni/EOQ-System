<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_models extends CI_Model {
	
	public function get($id = null)
	{
		$this->db->select('item.*, kategori.nama as kategori_name, brand.nama as brand_name, unit.unit as unit_name');
		$this->db->from('item');
		$this->db->join('kategori', 'kategori.kategori_id = item.kategori_id');
		$this->db->join('brand', 'brand.brand_id = item.brand_id');
		$this->db->join('unit', 'unit.unit_id = item.unit_id');
		if($id != null) {
			$this->db->where('item_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	
	public function del($id) 
	{
		$this->db->where('item_id', $id);
		$this->db->delete('item');
	}
	
	public function add($post)
	{
		$para = [
			'barcode' => $post['barcode'],
			'kriteria_id' => $post['kriteria_id'],
			'nama' => $post['nama'],
			'kategori_id' => $post['kategori'],
			'brand_id' => $post['brand'],
			'unit_id' => $post['unit'],
			'harga_pembelian' => $post['harga_pembelian'],
			'harga_penjualan' => $post['harga_penjualan'],
		];
		$this->db->insert('item', $para);
	}
	
	public function edit($post)
	{
		$para = [
		'barcode' => $post['barcode'],
			'nama' => $post['nama'],
			'kategori_id' => $post['kategori'],
			'brand_id' => $post['brand'],
			'unit_id' => $post['unit'],
			'harga_pembelian' => $post['harga_pembelian'],
			'harga_penjualan' => $post['harga_penjualan'],
		];
		$this->db->where('item_id', $post['item_id']);
		$this->db->update('item', $para);
	}
	
	function check_barcode($code, $id = null)
	{
		$this->db->from('item');
		$this->db->where('barcode', $code);
		if($id != null){
			$this->db->where('item_id !=', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	
	public function check_stock($stock)
	{
		$this->db->from('item');
		$this->db->where('stock', $stock);
		$query = $this->db->get();
		return $query;
	}
	
	function update_stock_in($data)
	{
		$qty = $data['qty'];
		$id = $data['item_id'];
		$sql = "UPDATE item SET stock = stock + '$qty' WHERE item_id = '$id'";
		$this->db->query($sql);
	}
	
	function update_stock_out($data)
	{
		$qty = $data['qty'];
		$id = $data['item_id'];
		$sql = "UPDATE item SET stock = stock - '$qty' WHERE item_id = '$id'";
		$this->db->query($sql);
	}
	
}