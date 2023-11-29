<?php

class Cviews extends CI_Controller
{
	/**
	 * Loading login page.
	 *
	 * @return void
	 */
	function loginpage()
	{
		$this->load->view('loginpage');
	}
 
	function register()
	{
		$this->load->view('Register');
	}

	/**
	 * Load input email form for forgot
	 * password mechanism.
	 *
	 * @return void
	 */
	function email()
	{
		$this->load->view('email');
	}
}
