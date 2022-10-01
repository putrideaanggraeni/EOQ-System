<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_models extends CI_Model {
	
	public function get($id = null)
	{
		$this->db->from('stock');
		if($id != null) {
			$this->db->where('stock_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	
	public function del($id)
	{
		$this->db->where('stock_id', $id);
		$this->db->delete('stock');
	}
	
	public function get_stock_in()
	{
		$this->db->select('stock.stock_id, item.barcode, item.nama as item_name, qty, date, detail, item.item_id, user.nama as user_name');
		$this->db->from('stock');
		$this->db->join('user', 'stock.user_id = user.user_id');
		$this->db->join('item', 'stock.item_id = item.item_id');
		$this->db->where('type', 'in');
		$this->db->order_by('stock_id');
		$query = $this->db->get();
		return $query;
	}
	
	public function get_stock_out()
	{
		$this->db->select('stock.stock_id, item.barcode, item.nama as item_name, qty, date, detail, item.item_id, user.nama as user_name');
		$this->db->from('stock');
		$this->db->join('user', 'stock.user_id = user.user_id');
		$this->db->join('item', 'stock.item_id = item.item_id');
		$this->db->where('type', 'out');
		$this->db->order_by('stock_id');
		$query = $this->db->get();
		return $query;
	}
	
	public function add_stock_in($post)
	{
		$para = [
			'item_id' => $post['item_id'],
			'type' => 'in',
			'detail' => $post['detail'],
			'qty' => $post['qty'],
			'date' => $post['date'],
			'user_id' => $this->session->userdata('user_id'),
		];
		$this->db->insert('stock', $para);
	}
	
	public function add_stock_out($post)
	{
		$para = [
			'item_id' => $post['item_id'],
			'type' => 'out',
			'detail' => $post['detail'],
			'qty' => $post['qty'],
			'date' => $post['date'],
			'user_id' => $this->session->userdata('user_id'),
		];
		$this->db->insert('stock', $para);
	}
}