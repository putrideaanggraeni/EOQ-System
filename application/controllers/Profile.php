<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		check_failed_login();
		$this->load->model('profile_models');
		$this->load->library('form_validation');
	}
	
	public function index()
	{
		$this->load->model('profile_models');
		$data['row'] = $this->profile_models->get();
		
		$this->template->load('template', 'profil/profil', $data);
	}
	
	public function edit($id)
	{
		$this->form_validation->set_rules('fullname', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_message('required', '%s masih kosong, silakan isi terlebih dahulu');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	
		
		if ($this->form_validation->run() == FALSE) {
			$query = $this->profile_models->get($id);
			if($query->num_rows() > 0){
				$data['row'] = $query->row();
				$this->template->load('template', 'profil/edit_profil', $data);
			} else {
				echo "<script>alert('Data tidak ditemukan');";
				echo "window.location='".site_url('profile')."';</script>";
			}
		} else {
			$post = $this->input->post(null, TRUE);
			$this->profile_models->edit($post);
			if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('success', 'Data berhasil diedit');
			}
			redirect('profile');
		}
	}
	
}
