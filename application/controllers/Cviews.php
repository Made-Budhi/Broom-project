<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Mreservasi $reservasi
 */

class Cviews extends CI_Controller
{
	/**
	 * Loading login page.
	 *
	 * @return void
	 */
	function broom_login_page(): void
	{
		$this->load->view('loginpage');
	}
 
	function broom_register_page(): void
	{
		$this->load->view('Register');
	}

	/**
	 * Load input email form for forgot
	 * password mechanism.
	 *
	 * @return void
	 */
	function email(): void
	{
		$this->load->view('email');
	}
}
