<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_models extends CI_Model {
	
	public function get($id = null)
	{
		$this->db->from('unit');
		if($id != null) {
			$this->db->where('unit_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	
	public function del($id) 
	{
		$this->db->where('unit_id', $id);
		$this->db->delete('unit');
	}
	
	public function add($post)
	{
		$para = [
			'unit' => $post['unit'],
		];
		$this->db->insert('unit', $para);
	}
	
	public function edit($post)
	{
		$para = [
			'unit' => $post['unit'],
		];
		$this->db->where('unit_id', $post['unit_id']);
		$this->db->update('unit', $para);
	}
}