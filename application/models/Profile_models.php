<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_models extends CI_Model {
		
	public function get($id = null)
	{
		$this->db->from('user');
		if($id != null) {
			$this->db->where('user_id', $id);
		}
		$query = $this->db->get();
		return $query;
			
	}
	
	public function edit($post)
	{
		$upload_image = $_FILES['gambar']['name'];
		
		if ($upload_image) {
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '2048';
			$config['upload_path'] = './assets/images/';
			
			$this->load->library('upload', $config);
			if($this->upload->do_upload('gambar')) {
				$new_image = $this->upload->data('file_name');
				$this->db->set('gambar', $new_image);
			} else {
				echo $this->upload->display_errors();
			}
		}
		
		$para['nama'] = $post['fullname'];
		$para['username'] = $post['username'];
		
		$this->db->where('user_id', $post['user_id']);
		$this->db->update('user', $para);
	}
	
}