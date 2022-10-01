<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_models extends CI_Model {
	
	public function get($id = null)
	{
		$this->db->select('*');
		$this->db->from('customer');
		if($id != null) {
			$this->db->where('customer_id', $id);
		}
		$this->db->order_by('customer_id', 'asc');
		$query = $this->db->get();
		return $query;
	}
	
	public function del($id) 
	{
		$this->db->where('customer_id', $id);
		$this->db->delete('customer');
	}
	
	public function add($post)
	{
		$para = [
			'nama' => $post['customer_name'],
			'alamat' => $post['alamat'],
			'nohp' => $post['nohp'],
		];
		$this->db->insert('customer', $para);
	}
	
	public function edit($post)
	{
		$para = [
			'nama' => $post['customer_name'],
			'alamat' => $post['alamat'],
			'nohp' => $post['nohp'],
		];
		$this->db->where('customer_id', $post['id']);
		$this->db->update('customer', $para);
	}
	
	
}