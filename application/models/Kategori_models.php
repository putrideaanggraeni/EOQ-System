<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_models extends CI_Model {
	
	public function get($id = null)
	{
		$this->db->from('kategori');
		if($id != null) {
			$this->db->where('kategori_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	
	public function del($id) 
	{
		$this->db->where('kategori_id', $id);
		$this->db->delete('kategori');
	}
	
	public function add($post)
	{
		$para = [
			'nama' => $post['nama'],
		];
		$this->db->insert('kategori', $para);
	}
	
	public function edit($post)
	{
		$para = [
			'nama' => $post['nama'],
		];
		$this->db->where('kategori_id', $post['kategori_id']);
		$this->db->update('kategori', $para);
	}
}