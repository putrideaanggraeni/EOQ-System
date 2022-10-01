<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		check_failed_login();
		check_kasir();
		$this->load->model(['transaksi_models', 'item_models', 'stock_models', 'customer_models']);
	}	
	
	public function index()
	{
		
		$tahun = date('Y');
		$bulan = date('m');
		$tanggal = date('d');
		$getLastFaktur = $this->transaksi_models->getLastFaktur($tahun,$bulan,$tanggal)->row_array();
		$nomer_terakhir = $getLastFaktur['no_faktur'];
		$no_faktur = buatKode($nomer_terakhir, 'TR' . $tahun . $bulan. $tanggal, 4);
		$customer = $this->customer_models->get()->result();
		$item = $this->item_models->get()->result();
		$keranjang = $this->transaksi_models->get();
		$dt = $this->transaksi_models->getData();
		$diskon = $this->transaksi_models->getDiskon();
		$data = ['no_faktur' => $no_faktur,
		'customer' => $customer,
		'item' => $item,
		'row' => $keranjang,
		'dt' => $dt,
		'diskon' => $diskon];
		
		$this->template->load('template', 'transaksi/transaksi_data', $data );
	}
	
	public function add()
	{
		$keranjang = new stdClass();
		$keranjang->no_faktur = null;
		$keranjang->barcode = null;
		$keranjang->item_id = null;
		$keranjang->harga_penjualan = null;
		$keranjang->qty = null;
		$keranjang->diskon_id = null;
		
		$data = array(
			'page'=> 'add',
			'row'=> $keranjang
		);
		redirect('transaksi/transaksi_data');
	}
	
	public function simpanDetail()
	{
		$detail = new stdClass();
		$detail->no_faktur = null;
		$detail->tanggal = null;
		$detail->barcode = null;
		$detail->item_id = null;
		$detail->harga_penjualan = null;
		$detail->qty = null;
		
		$data = array(
			'page'=> 'simpanDetail',
			'row'=> $detail
		);
		redirect('transaksi/transaksi_data');
	}
	
	public function simpanData()
	{
		$dt = new stdClass();
		$dt->no_faktur = null;
		$dt->tanggal = null;
		$dt->barcode = null;
		$dt->item_id = null;
		$dt->harga_penjualan = null;
		$dt->qty = null;
		
		$data = array(
			'page'=> 'simpanData',
			'dt'=> $dt
		);
		redirect('transaksi/transaksi_data');
	}
	
	
	public function simpan()
	{
		$transaksi = new stdClass();
		$transaksi->no_faktur = null;
		$transaksi->tanggal = null;
		$transaksi->user_id = null;
		$transaksi->customer_id = null;
		$transaksi->metode_pembayaran = null;
		$transaksi->total_bersih = null;
		$transaksi->discount = null;
		
		$data = array(
			'page'=> 'simpan',
			'row'=> $transaksi
		);
		redirect('transaksi/transaksi_data');
	}
	
	
	public function proses()
	{
		$stock = $this->input->post('stock');
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])) {
			if ($this->transaksi_models->check_barcode($post['barcode'])->num_rows() <= 0) {
				if (($this->input->post('stock')-$this->input->post('qty')) >= 0 ) {
					$this->transaksi_models->add($post);
					$this->item_models->update_stock_out($post);
					
					if($this->db->affected_rows() > 0){
						$this->session->set_flashdata('success', 'Data berhasil dimasukkan ke keranjang');
					}
					redirect('transaksi');
				} else{
					$this->session->set_flashdata('error', "Stock tidak mencukupi, stock saat ini $stock");
					redirect('transaksi');
				}
			} 
			else {
				if (($this->input->post('stock')-$this->input->post('qty')) >= 0 ) {
					$this->transaksi_models->update($post);
					$this->item_models->update_stock_out($post);
					
					if($this->db->affected_rows() > 0){
						$this->session->set_flashdata('success', 'Data berhasil dimasukkan ke keranjang');
					}
					redirect('transaksi');
				} else{
					$this->session->set_flashdata('error', "Stock tidak mencukupi, stock saat ini $stock");
					redirect('transaksi');
				}
				
			} 
				if($this->db->affected_rows() > 0 ){
				echo "<script>alert('Data berhasil disimpan'); </script>";
				echo "<script>window.location='".site_url('transaksi')."';</script>";
			}
			
		} else if(isset($_POST['simpan'])) {
			if ($this->input->post('bayar') > 0) {
				if ($this->transaksi_models->check_barang($post['barcode'])->num_rows() <= 0) {
					$this->transaksi_models->simpanDetail($post);
					$this->transaksi_models->simpanData($post);
					$this->transaksi_models->simpan($post);
					$this->transaksi_models->emp();
						
					if($this->db->affected_rows() > 0){
						$this->session->set_flashdata('success', 'Data berhasil disimpan');
					}
					redirect('transaksi');
				} if ($this->transaksi_models->check_barang($post['barcode'])->num_rows() >= 0) {
					if ($this->transaksi_models->check_tanggal($post['tanggal'])->num_rows() <= 0) {
						$this->transaksi_models->simpanDetail($post);
						$this->transaksi_models->simpanData($post);
						$this->transaksi_models->simpan($post);
						$this->transaksi_models->emp();
						
						if($this->db->affected_rows() > 0){
							$this->session->set_flashdata('success', 'Data berhasil disimpan');
						}
						redirect('transaksi');
					} if ($this->transaksi_models->check_tanggal($post['tanggal'])->num_rows() >= 0) {
						$this->transaksi_models->simpanDetail($post);
						$this->transaksi_models->updateData($post);
						$this->transaksi_models->simpan($post);
						$this->transaksi_models->emp();
						
						if($this->db->affected_rows() > 0){
							$this->session->set_flashdata('success', 'Data berhasil disimpan');
						}
						redirect('transaksi');
					}	
				}		
			} else {
				$this->session->set_flashdata('error', "Jumlah bayar tidak boleh kosong");
				redirect('transaksi');
			}
			
		} if(isset($_POST['print'])) {
			if ($this->input->post('bayar') > 0) {
				if ($this->transaksi_models->check_barang($post['barcode'])->num_rows() <= 0) {
					$tanggal = $this->input->post('tanggal');
					$data['tanggal'] = $tanggal;
					$discount = $this->input->post('discount');
					$data['discount'] = $discount;
					$total_bersih = $this->input->post('total_bersih');
					$data['total_bersih'] = $total_bersih;
					$bayar = $this->input->post('bayar');
					$data['bayar'] = $bayar;
					$sisa = $this->input->post('sisa');
					$data['sisa'] = $sisa;
					$data ['row'] = $this->transaksi_models->get()->result();
					$this->transaksi_models->simpanDetail($post);
					$this->transaksi_models->simpanData($post);
					$this->transaksi_models->simpan($post);
					$this->transaksi_models->emp();
					
					$this->load->view('transaksi/cetak_nota', $data);
				} if ($this->transaksi_models->check_barang($post['barcode'])->num_rows() >= 0) {
					if ($this->transaksi_models->check_tanggal($post['tanggal'])->num_rows() <= 0) {
						$tanggal = $this->input->post('tanggal');
						$data['tanggal'] = $tanggal;
						$discount = $this->input->post('discount');
						$data['discount'] = $discount;
						$total_bersih = $this->input->post('total_bersih');
						$data['total_bersih'] = $total_bersih;
						$bayar = $this->input->post('bayar');
						$data['bayar'] = $bayar;
						$sisa = $this->input->post('sisa');
						$data['sisa'] = $sisa;
						$data ['row'] = $this->transaksi_models->get()->result();
						$this->transaksi_models->simpanDetail($post);
						$this->transaksi_models->simpanData($post);
						$this->transaksi_models->simpan($post);
						$this->transaksi_models->emp();
						
						$this->load->view('transaksi/cetak_nota', $data);
					} if ($this->transaksi_models->check_tanggal($post['tanggal'])->num_rows() >= 0) {
						$tanggal = $this->input->post('tanggal');
						$data['tanggal'] = $tanggal;
						$discount = $this->input->post('discount');
						$data['discount'] = $discount;
						$total_bersih = $this->input->post('total_bersih');
						$data['total_bersih'] = $total_bersih;
						$bayar = $this->input->post('bayar');
						$data['bayar'] = $bayar;
						$sisa = $this->input->post('sisa');
						$data['sisa'] = $sisa;
						$data ['row'] = $this->transaksi_models->get()->result();
						$this->transaksi_models->simpanDetail($post);
						$this->transaksi_models->updateData($post);
						$this->transaksi_models->simpan($post);
						$this->transaksi_models->emp();
						
						$this->load->view('transaksi/cetak_nota', $data);
					}	
				}		
			} else {
				$this->session->set_flashdata('error', "Jumlah bayar tidak boleh kosong");
				redirect('transaksi');
			}
				
		}
	}
	
	public function del($id)
	{
		$id = $this->uri->segment(3);
		$item_id = $this->uri->segment(4);
		$qty = $this->transaksi_models->get($id)->row()->qty;
		$data = ['qty' => $qty, 'item_id' => $item_id];
		$this->item_models->update_stock_in($data);
		$this->transaksi_models->del($id);
		//$this->transaksi_models->delDetail($id);
		
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('transaksi');
	}
	
	public function emp()
	{
		$this->transaksi_models->emp();
		if($this->db->affected_rows() > 0) {
			echo "<script>alert('Data berhasil dihapus');</script>";
		}
		echo "<script>window.location='".site_url('transaksi')."';</script>";
	}
	
	public function cetakNota()
	{
			$data ['row'] = $this->transaksi_models->getNota()->result();
			$this->load->view('transaksi/cetak_nota', $data);
	}
}
