<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Maccount $account
 * @property CI_Session $session
 * @property CI_Input $input
 */
class Chalaman extends Broom_Controller
{
	/**
	 * Loading otp input page.
	 *
	 * @return void
	 */
	public function otp(): void
	{
		$this->load->view('otp');
	}
	
	/**
	 * Determines the validity of the otp code
	 *
	 * @return void
	 */
	public function reset(): void
	{
		/*
		 * Checking whether the otp is the correct one or not.
		 * If correct		= go to reset password page
		 * If not			= go back to otp input page
		 */
		if ($this->session->userdata('token') == $this->input->post('token')) {
			$this->load->view('reset');
		} else {
			redirect('chalaman/otp');
		}
	}
	
	/**
	 * Calling model for resetting password
	 */
	public function newpass(): void
	{
		$this->account->newpass($this->input->post('password'));
	}
}

