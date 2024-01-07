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
		$this->load->model('Mpengelola', 'pengelola');
	}
	
	//dummpy
	function index(): void
	{
		$this->load->view('layouts/sidebar_pengelola');
	}
	
	function data_akun(): void
	{
		$peminjam['hasil'] = $this->pengelola->datasingkat();
		$data['content']=$this->load->view('view_peminjam',$peminjam,TRUE);
		$data['current_uri'] 	= "data_akun";
		$this->load->view('layouts/sidebar_pengelola',$data);
	}
	
	function jejak($id): void
	{
		$peminjam['hasil'] = $this->pengelola->jejakreservasi($id);
		$data['content']=$this->load->view('reservasi_peminjam',$peminjam,TRUE);
		$data['current_uri'] 	= "data_akun";
		$this->load->view('layouts/sidebar_pengelola',$data);
	}
}
