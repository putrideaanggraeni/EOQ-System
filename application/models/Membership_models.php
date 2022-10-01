<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership_models extends CI_Model {
	
	public function get($id = null)
	{
		$this->db->select('*');
		$this->db->from('membership');
		if($id != null) {
			$this->db->where('member_id', $id);
		}
		$this->db->order_by('member_id', 'asc');
		$query = $this->db->get();
		return $query;
	}
	
	public function del($id) 
	{
		$this->db->where('member_id', $id);
		$this->db->delete('membership');
	}
	
	public function add($post)
	{
		$para = [
			'nama' => $post['member_name'],
			'alamat' => $post['alamat'],
			'nohp' => $post['nohp'],
		];
		$this->db->insert('membership', $para);
	}
	
	public function edit($post)
	{
		$para = [
			'nama' => $post['member_name'],
			'alamat' => $post['alamat'],
			'nohp' => $post['nohp'],
		];
		$this->db->where('member_id', $post['id']);
		$this->db->update('membership', $para);
	}
	
	
}