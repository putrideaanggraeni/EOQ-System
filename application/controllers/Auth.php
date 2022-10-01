<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function login()
	{
		check_already_login();
		$this->load->view('login');
	}
	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($post['login'])) {
			$this->load->model('user_models');
			$query = $this->user_models->login($post);
			?>
			
			<link rel ="stylesheet" href="<?php echo base_url();?>assets/dist/libs/sweetalert/sweetalert2.min.css">
			<script src="<?php echo base_url();?>assets/dist/libs/sweetalert/sweetalert2.min.js"></script>
			<style>
			body {
				font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
				font-size: 1.124em;
				font-weight: normal;
			}
			</style>
			<head>
				<title>Kawan Ban</title>
				<link rel="shortcut icon" href="<?=base_url()?>assets/kawanbanlogo.png" type="image/x-icon" class="img-circle profile_img">
			</head>
			<body></body>
			
			<?php
			if($query->num_rows() > 0) {
				$row = $query->row();
				$para = array(
				'user_id' => $row->user_id,
				'level' => $row->level
				);
				$this->session->set_userdata($para);
			?>	
			<script> 
				Swal.fire({
					icon: 'success',
					title: 'Success',
					text: 'Selamat, Login Berhasil!',
					confirmButtonColor: '#1E90FF'
				}). then((result) => {
					window.location='<?=site_url('dashboard')?>';
				})
			</script>
			<?php 
			} else {
			?>	
			<script> 
				Swal.fire({
					icon: 'error',
					title: 'Failure',
					text: 'Login Gagal! Username atau Password yang Anda Masukkan Salah',
					confirmButtonColor: '#1E90FF'
				}). then((result) => {
					window.location='<?=site_url('auth/login')?>';
				})
			</script>
			<?php
			}
		}
	}
	public function logout()
	{
		$para = array('user_id','level');
		$this->session->unset_userdata($para);
		redirect('auth/login');
	}
}
