<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		check_failed_login();
		check_pemilik();
		$this->load->model(['laporan_models', 'membership_models']);
	}
	
	public function index()
	{		
		
		$dari = "";
		$sampai = "";
		
			
		if ($this->session->userdata('dari') != NULL) {
					$dari= $this->session->userdata('dari');
				}
				if ($this->session->userdata('sampai') != NULL) {
					$sampai = $this->session->userdata('sampai');
				}		
			
		
		
		$data ['row'] = $this->laporan_models->get();
		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$this->template->load('template', 'laporan/laporanpenjualan', $data);			
	}
	
	public function del($id)
	{
		$this->laporan_models->del($id);
		if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}
		redirect('laporan');
	}
	
	public function detail($id)
	{
		$query = $this->laporan_models->get($id);
		$data['row'] = $this->laporan_models->get($id)->row_array();
		$data['detail'] = $this->laporan_models->getDetail($id)->result();
		$this->template->load('template', 'transaksi/detail_transaksi', $data);		
	}
	
	public function cetaklaporanpenjualan()
	{
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');
		$data = array(
		'dari' => $dari,
		'sampai' => $sampai
		);
		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$data ['row'] = $this->laporan_models->getLaporanPenjualan($dari,$sampai)->result();
		if (isset($_POST['export'])) {
			header("Content-type: application/vnd-ms-excel");
			header("Content-Disposition: attachment; filename=Laporan Penjualan.xls");
		}		
		$this->load->view('laporan/cetak_laporanpenjualan', $data);
	}
}
	

