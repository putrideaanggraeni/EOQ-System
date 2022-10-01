<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diskon extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		check_failed_login();
		check_pemilik();
		$this->load->model('diskon_models');
	}
	
	public function index()
	{
		$data['row'] = $this->diskon_models->get();
		$this->template->load('template', 'diskon/diskon_form', $data);
	}
	
	public function edit()
	{
		$query = $this->diskon_models->get();
		if($query->num_rows() > 0) {
			$diskon = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $diskon
			);
			$this->template->load('template', 'diskon/diskon_edit', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='".site_url('diskon')."';</script>";
		}
	}
	
	public function proses()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['edit'])) {
			$this->diskon_models->edit($post);
		}
		
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
		redirect('diskon');
	}
	
}
