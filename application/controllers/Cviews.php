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
}
