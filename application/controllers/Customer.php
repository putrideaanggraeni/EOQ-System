<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		check_failed_login();
		check_admin();
		$this->load->model('customer_models');
	}
	
	public function index()
	{
		$data['row'] = $this->customer_models->get();
		$this->template->load('template', 'customer/customer_data', $data);
	}
	
	public function add()
	{
		$customer = new stdClass();
		$customer->customer_id = null;
		$customer->nama = null;
		$customer->alamat = null;
		$customer->nohp = null;
		$data = array(
			'page' => 'add',
			'row' => $customer
		);
		$this->template->load('template', 'customer/customer_form', $data);
	}
	
	public function edit($id)
	{
		$query = $this->customer_models->get($id);
		if($query->num_rows() > 0) {
			$customer = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $customer
			);
			$this->template->load('template', 'customer/customer_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='".site_url('customer')."';</script>";
		}
	}
	
	public function proses()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])) {
			$this->customer_models->add($post);
		} else if(isset($_POST['edit'])) {
			$this->customer_models->edit($post);
		}
		
		if($this->db->affected_rows() > 0){
		$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
		redirect('customer');
	}
	
	public function del($id)
	{
		$this->customer_models->del($id);
		if($this->db->affected_rows() > 0){
		$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('customer');
	}
}

