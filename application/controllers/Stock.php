<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		check_failed_login();
		check_admin();
		$this->load->model(['stock_models','item_models', 'eoq_models']);
	}
	public function stock_in_data(){
		$data['row'] = $this->stock_models->get_stock_in()->result();
		$this->template->load('template', 'barang/stock_in/stock_in_data', $data);
	}
	public function stock_in_add(){
		$item = $this->item_models->get()->result();
		$data = ['item' => $item];
		$this->template->load('template', 'barang/stock_in/stock_in_form', $data);
	}
	public function stock_out_data(){
		$data['row'] = $this->stock_models->get_stock_out()->result();
		$this->template->load('template', 'barang/stock_out/stock_out_data', $data);
	}
	public function stock_out_add(){
		$item = $this->item_models->get()->result();
		$data = ['item' => $item];
		$this->template->load('template', 'barang/stock_out/stock_out_form', $data);
	}
	public function proses(){
		if(isset($_POST['in_add'])) {
			$post = $this->input->post(null, TRUE);
			$this->stock_models->add_stock_in($post);
			$this->item_models->update_stock_in($post);
			$this->eoq_models->batalkan($post);
			if($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'Data Stock-In berhasil disimpan');
			}
			redirect('stock/in');
		}else if(isset($_POST['out_add'])) {
			$post = $this->input->post(null, TRUE);
			$this->stock_models->add_stock_out($post);
			$this->item_models->update_stock_out($post);
			if($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'Data Stock-Out berhasil disimpan');
			}
			redirect('stock/out');
		}
	}
	public function stock_in_del()
	{
		$stock_id = $this->uri->segment(4);
		$item_id = $this->uri->segment(5);
		$qty = $this->stock_models->get($stock_id)->row()->qty;
		$data = ['qty' => $qty, 'item_id' => $item_id];
		$this->item_models->update_stock_out($data);
		$this->stock_models->del($stock_id);
		$this->eoq_models->pesan($data);
		if($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data stock-in berhasil dihapus');
		}
		redirect('stock/in');
	}
	public function stock_out_del()
	{
		$stock_id = $this->uri->segment(4);
		$item_id = $this->uri->segment(5);
		$qty = $this->stock_models->get($stock_id)->row()->qty;
		$data = ['qty' => $qty, 'item_id' => $item_id];
		$this->item_models->update_stock_in($data);
		$this->stock_models->del($stock_id);
		if($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data stock-out berhasil dihapus');
		}
		redirect('stock/out');
	}
	
}