<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class unit extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		check_failed_login();
		check_admin();
		$this->load->model('unit_models');
	}
	
	public function index()
	{
		$data['row'] = $this->unit_models->get();
		$this->template->load('template', 'barang/unit/unit_data', $data);
	}
	
	public function add()
	{
		$unit = new stdClass();
		$unit->unit_id = null;
		$unit->unit = null;
		$data = array(
			'page'=> 'add',
			'row'=> $unit
		);
		$this->template->load('template', 'barang/unit/unit_form', $data);
	}
	
	public function edit($id)
	{
		$query = $this->unit_models->get($id);
		if($query->num_rows() > 0) {
			$unit = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $unit
			);
			$this->template->load('template', 'barang/unit/unit_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='".site_url('unit')."';</script>";
		}
	}
	
	public function proses()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])) {
			$this->unit_models->add($post);
		} else if(isset($_POST['edit'])) {
			$this->unit_models->edit($post);
		}
		
		if($this->db->affected_rows() > 0){
		$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
		redirect('unit');
	}
	
	public function del($id)
	{
		$this->unit_models->del($id);
		if($this->db->affected_rows() > 0){
		$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('unit');
	}
}

