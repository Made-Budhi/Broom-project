<?php
	class Chalaman extends CI_Controller
	{
		function tampil()
		{
			$this->load->view('halamantampil');	
		}
		
		function daftar()
		{
			$this->load->view('halamandaftar');	
		}

		function proseslogin(){
			$this->load->model('mlogin');	
			$this->mlogin->proseslogin();
		}

		function email()
		{
			$this->load->view('email');	
		}

		function otp()
		{
			$this->load->view('otp');	
		}

		function reset()
		{
			if($this->session->userdata('token')==$this->input->post('token')){
				$this->load->view('reset');	
			}
			else{
				redirect('chalaman/otp');
			}
		}

		function newpass(){
			$this->load->model('Mverif');
			$this->Mverif->newpass($this->input->post('password'));
		}
	}
?>