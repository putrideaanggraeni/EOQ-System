<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		check_failed_login();
		check_admin();
		$this->load->model('brand_models');
	}
	
	public function index()
	{
		$data['row'] = $this->brand_models->get();
		$this->template->load('template', 'barang/brand/brand_data', $data);
	}
	
	public function add()
	{
		$brand = new stdClass();
		$brand->brand_id = null;
		$brand->nama = null;
		$data = array(
			'page'=> 'add',
			'row'=> $brand
		);
		$this->template->load('template', 'barang/brand/brand_form', $data);
	}
	
	public function edit($id)
	{
		$query = $this->brand_models->get($id);
		if($query->num_rows() > 0) {
			$brand = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $brand
			);
			$this->template->load('template', 'barang/brand/brand_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='".site_url('brand')."';</script>";
		}
	}
	
	public function proses()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])) {
			$this->brand_models->add($post);
		} else if(isset($_POST['edit'])) {
			$this->brand_models->edit($post);
		}
		
		if($this->db->affected_rows() > 0){
		$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
		redirect('brand');
	}
	
	public function del($id)
	{
		$this->brand_models->del($id);
		if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('brand');
	}
}

