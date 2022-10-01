<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diskon_models extends CI_Model {
	
	public function get($id = null)
	{
		$this->db->from('diskon');
		if($id != null) {
			$this->db->where('diskon_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	
	public function edit($post)
	{
		$para = [
			'diskon' => $post['diskon'],
			'ket_diskon' => $post['ket_diskon']
		];
		$this->db->where('diskon_id', $post['diskon_id']);
		$this->db->update('diskon', $para);
	}
}	