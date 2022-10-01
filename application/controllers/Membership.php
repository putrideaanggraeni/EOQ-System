<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		check_failed_login();
		$this->load->model('membership_models');
	}
	
	public function index()
	{
		$data['row'] = $this->membership_models->get();
		$this->template->load('template', 'membership/membership_data', $data);
	}
	
	public function add()
	{
		$membership = new stdClass();
		$membership->member_id = null;
		$membership->nama = null;
		$membership->alamat = null;
		$membership->nohp = null;
		$data = array(
			'page' => 'add',
			'row' => $membership
		);
		$this->template->load('template', 'membership/membership_form', $data);
	}
	
	public function edit($id)
	{
		$query = $this->membership_models->get($id);
		if($query->num_rows() > 0) {
			$membership = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $membership
			);
			$this->template->load('template', 'membership/membership_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='".site_url('membership')."';</script>";
		}
	}
	
	public function proses()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])) {
			$this->membership_models->add($post);
		} else if(isset($_POST['edit'])) {
			$this->membership_models->edit($post);
		}
		
		if($this->db->affected_rows() > 0 ){
			echo "<script>alert('Data berhasil disimpan'); </script>";
		}
		echo "<script>window.location='".site_url('membership')."';</script>";
	}
	
	public function del($id)
	{
		$this->membership_models->del($id);
		if($this->db->affected_rows() > 0) {
			echo "<script>alert('Data berhasil dihapus');</script>";
		}
		echo "<script>window.location='".site_url('membership')."';</script>";
	}
}

