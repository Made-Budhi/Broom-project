<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */

class Cpengelola extends Broom_Controller
{
	public function __construct()
    {
        parent::__construct();
    }

	//dummpy
	function index(): void
	{
		$this->load->view('layouts/sidebar_pengelola');
	}
}

?>
