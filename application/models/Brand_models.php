<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_models extends CI_Model {
	
	public function get($id = null)
	{
		$this->db->from('brand');
		if($id != null) {
			$this->db->where('brand_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	
	public function del($id) 
	{
		$this->db->where('brand_id', $id);
		$this->db->delete('brand');
	}
	
	public function add($post)
	{
		$para = [
			'nama' => $post['nama'],
		];
		$this->db->insert('brand', $para);
	}
	
	public function edit($post)
	{
		$para = [
			'nama' => $post['nama'],
		];
		$this->db->where('brand_id', $post['brand_id']);
		$this->db->update('brand', $para);
	}
}