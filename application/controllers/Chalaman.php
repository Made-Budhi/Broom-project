<?php
/**
 * @property Mverif $verif
 */
class Chalaman extends CI_Controller
{
	/**
	 * Loading otp input page.
	 *
	 * @return void
	 */
	function otp()
	{
		$this->load->view('otp');
	}

	/**
	 * Determines the validity of the otp code
	 *
	 * @return void
	 */
	function reset()
	{
		/*
		 * Checking whether the otp is the correct one or not.
		 * If correct		= go to reset password page
-		 * If not			= go back to otp input page
		 */
		if($this->session->userdata('token')==$this->input->post('token')) {
			$this->load->view('reset');
		}
		else{
			redirect('chalaman/otp');
		}
	}

	/**
	 * Calling model for resetting password
	 */
	function newpass(){
		$this->load->model('Mverif', 'verif');
		$this->verif->newpass($this->input->post('password'));
	}
}

