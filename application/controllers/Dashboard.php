<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		check_failed_login();
		$this->load->model(['transaksi_models', 'eoq_models']);
	}
	
	public function index()
	{
		$data['brg'] = $this->eoq_models->getBrgPerBulan()->result();
		$data['rop'] = $this->eoq_models->getrop()->result();
		$data['penjualanreport'] = $this->transaksi_models->getPenjualanPerBulan()->result();
		$data['pendapatan'] = $this->transaksi_models->getPendapatan()->result();
		$this->template->load('template', 'dashboard', $data);
	}
}
