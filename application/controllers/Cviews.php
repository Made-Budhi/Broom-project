<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

	function dashboard()
	{
		// Load Model to get Reservasi DATABASE
		$this->load->model('Mreservasi');
		// add variable and get DATABASE reservasi
		$tableR['hasil'] = $this->Mreservasi->tampildata();
		// Load Dashboard and put DATABASE from resevasi to table
        $data['konten']=$this->load->view('dashboard',$tableR,TRUE);
		$this->load->view('layouts/sidebar',$data);
	}

	
}
