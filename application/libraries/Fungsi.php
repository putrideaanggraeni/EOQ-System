<?php

Class Fungsi {
	
	protected $ci;
	
	public function __construct() {
		$this->ci =& get_instance ();
		
	}
	
	function user_login(){
		$this->ci->load->model('user_models');
		$user_id = $this->ci->session->userdata('user_id');
		$user_data = $this->ci->user_models->get($user_id)->row();
		return $user_data;
	}
	
	public function count_item() {
		$this->ci->load->model('item_models');
		return $this->ci->item_models->get()->num_rows();
	}
	
	public function count_user() {
		$this->ci->load->model('user_models');
		return $this->ci->user_models->get()->num_rows();
	}
	
	public function count_customer() {
		$this->ci->load->model('customer_models');
		return $this->ci->customer_models->get()->num_rows();
	}
		
}