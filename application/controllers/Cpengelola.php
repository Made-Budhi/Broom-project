<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 * 
 */

class Cpengelola extends Broom_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mpengelola', 'pengelola');
		$this->load->model('Mpemimpin', 'pimpinan');
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

	function view_data_pimpinan()
	{
		$tampil['hasil']=$this->pengelola->tampildata();
		$data['content']=$this->load->view('menu_pengelola/data_pimpinan',$tampil,TRUE);
		$data['form']=$this->load->view('menu_pengelola/form','',TRUE);
		$this->load->view('layouts/sidebar_pengelola', $data);
	}

	function edit_pimpinan() {
		$data = $this->pimpinan->get_data_pimpinan($this->input->post('id'));
		echo json_encode($data);
	}

	function simpandata(){
		$this->pengelola->simpandata();

	}

	function hapusdata($account_id){
		$this->pengelola->hapusdata($account_id);
	}
}

