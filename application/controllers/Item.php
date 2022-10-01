<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		check_failed_login();
		check_admin();
		$this->load->model(['item_models', 'kategori_models', 'brand_models', 'unit_models']);
	}
	
	public function index()
	{
		$data['row'] = $this->item_models->get();
		$this->template->load('template', 'barang/item/item_data', $data);
	}
	
	public function add()
	{
		$item = new stdClass();
		$item->item_id = null;
		$item->kriteria_id = null;
		$item->barcode = null;
		$item->nama = null;
		$item->harga_pembelian= null;
		$item->harga_penjualan = null;
		$item->kategori_id = null;
		$item->brand_id = null;
		$item->unit_id= null;
		
		$kategori = $this->kategori_models->get();
		$brand = $this->brand_models->get();
		$unit = $this->unit_models->get();
		
		$data = array(
			'page'=> 'add',
			'row'=> $item,
			'kategori'=> $kategori,
			'brand'=> $brand,
			'unit'=> $unit,
		);
		$this->template->load('template', 'barang/item/item_form', $data);
	}
	
	public function edit($id)
	{
		$query = $this->item_models->get($id);
		if($query->num_rows() > 0) {
			$item = $query->row();
			$kategori = $this->kategori_models->get();
			$brand = $this->brand_models->get();
			$unit = $this->unit_models->get();
		
			$data = array(
			'page'=> 'edit',
			'row'=> $item,
			'kategori'=> $kategori,
			'brand'=> $brand,
			'unit'=> $unit,
		);
			$this->template->load('template', 'barang/item/item_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='".site_url('item')."';</script>";
		}
	}
	
	public function proses()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])) {
			if($this->item_models->check_barcode($post['barcode'])->num_rows() > 0) {
				$this->session->set_flashdata('error', "Barcode $post[barcode] sudah dipakai");
				redirect('item/add');
			} else {
				$this->item_models->add($post);
			}
			if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
			redirect('item');
			}
		} else if(isset($_POST['edit'])) {
			if($this->item_models->check_barcode($post['barcode'], $post['item_id'])->num_rows() > 0) {
				$this->session->set_flashdata('error', "Barcode $post[barcode] sudah dipakai");
				redirect('item/edit/'.$post['item_id']);
		} else {
			$this->item_models->edit($post);
		}	
		if($this->db->affected_rows() > 0){
		$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
		redirect('item');
		}
	}
	
	public function del($id)
	{
		$this->item_models->del($id);
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('item');
	}
	
	public function cetak()
	{
		$data['row'] = $this->item_models->get();
		$this->load->view('barang/item/cetak_data_item', $data);
	}
	
	public function export()
	{
		$data['row'] = $this->item_models->get();
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Data Barang.xls");
		$this->load->view('barang/item/cetak_data_item', $data);
	}
	
	
}

