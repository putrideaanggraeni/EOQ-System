<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EOQ extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		check_failed_login();
		check_pemilik();
		$this->load->model(['eoq_models', 'item_models', 'transaksi_models', 'laporan_models']);
	}
	
	public function index()
	{
		$data['row'] = $this->eoq_models->get();
		$data['jmlstock'] = $this->eoq_models->getrop()->result();
		$data['brgperhari'] = $this->eoq_models->getBrgTerjual()->result();
		$data['jmlbrg'] = $this->eoq_models->getBrgTerjual()->result();
		$this->template->load('template', 'EOQ/EOQ_Data', $data);
	}
	
	public function kelola()
	{
		$data['row'] = $this->eoq_models->get();
		$this->template->load('template', 'EOQ/EOQ_form', $data);
	}
	
	public function listrop()
	{
		$data['row'] = $this->eoq_models->getBrgTerjual()->result();
		$this->template->load('template', 'EOQ/list_rop', $data);
	}
	
	public function edit()
	{
		$query = $this->eoq_models->get();
		if($query->num_rows() > 0) {
			$kriteria = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $kriteria
			);
			$this->template->load('template', 'EOQ/EOQ_edit', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='".site_url('eoq')."';</script>";
		}
	}
	
	public function proses()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['edit'])) {
			$this->eoq_models->edit($post);
		}
		
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
		redirect('eoq/kelola');
	}
	
	public function cetak()
	{
		$data['row'] = $this->eoq_models->getBrgTerjual()->result();
		$this->load->view('EOQ/cetak_data_rop', $data);
	}
	
	public function export()
	{
		$data['row'] = $this->eoq_models->getBrgTerjual()->result();
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Data Re Order Barang.xls");
		$this->load->view('EOQ/cetak_data_rop', $data);
	}

	
	public function pesan($id)
	{
		$item_id = $this->uri->segment(3);
		$data = ['item_id' => $item_id];
		$this->eoq_models->pesan($data);
		
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('eoq/listrop');
	}
	
	public function batalkan($id)
	{
		$item_id = $this->uri->segment(3);
		$data = ['item_id' => $item_id];
		$this->eoq_models->batalkan($data);
		
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('eoq/listrop');
	}
}
