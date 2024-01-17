<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 
 */

class Cerror extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index(){
		return $this->load->view('errors/Broom_404');
	}
}
