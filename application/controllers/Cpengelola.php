<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Mpengelola $pengelola
 * @property Mpemimpin $pimpinan
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Upload $upload
 * @property CI_URI $uri
 */

class Cpengelola extends Broom_Controller
{
	private array $current_session;
	private array $data = array();
	private array $view = array();
	private array $html = array('current_uri' => 'ruangan');

	public function __construct()
	{
		parent::__construct();
		$this->_check_is_logged_in();
		$this->load->model('Mpengelola', 'pengelola');
		$this->load->model('Mpemimpin', 'pimpinan');
		$this->current_session = $this->session->get_userdata();
		
		$role = $this->current_session['role'];
		
		// Determine which page should be loaded.
		switch ($role) {
			case AccountRole::PIMPINAN:
			case AccountRole::PEMINJAM:
				redirect('dashboard');
				break;

			case AccountRole::PENGELOLA:
				$this->data['hasil'] = $this->pengelola->tampildata();
				$this->view['content'] = 'menu_pengelola/roomlist';
				$this->view['sidebar'] = 'layouts/sidebar_pengelola';
				break;
		}
	}
	
	function index(): void
	{
		$this->html['content'] = $this->load
				->view($this->view['content'], $this->data, true);
		$this->load->view($this->view['sidebar'], $this->html);
	}
	
	function view_data_peminjam(): void
	{
		$peminjam['hasil'] = $this->pengelola->datasingkat();
		$data['content']=$this->load->view('view_peminjam',$peminjam,TRUE);
		$data['current_uri'] 	= "data_akun";
		$data['search_on_table'] = 'Peminjam';
		$data['search_url'] = 'account/peminjam/history/';
		$this->load->view('layouts/sidebar_pengelola',$data);
	}
	
	function jejak($id): void
	{
		$peminjam['hasil'] = $this->pengelola->jejakreservasi($id);
		$data['content']=$this->load->view('reservasi_peminjam',$peminjam,TRUE);
		$data['current_uri'] 	= "data_akun";
		$this->load->view('layouts/sidebar_pengelola',$data);
	}

	function view_data_pimpinan(): void
	{
		$tampil['hasil']=$this->pengelola->tampildata();
		$data['content']=$this->load->view('menu_pengelola/data_pimpinan',$tampil,TRUE);
		$data['form']=$this->load->view('menu_pengelola/form','',TRUE);
		$data['search_on_table'] = 'Pimpinan';
		$data['search_url'] = 'account/pimpinan/history/';
		$data['current_uri'] = 'data_akun';

		$this->load->view('layouts/sidebar_pengelola', $data);
	}

	function edit_pimpinan(): void
	{
		$data = $this->pimpinan->get_data_pimpinan($this->input->post('id'));
		echo json_encode($data);
	}

	function simpandata(): void
	{
		$config = array(
			'upload_path' 	=> FCPATH . 'assets/images/signature_pimpinan/',
			'allowed_types' => 'jpg|png',
			'max_size' 		=> 0,
			'max_width'		=> 0,
			'max_height'	=> 0
		);
		
		$this->load->library('upload', $config);
		$data['image'] = upload_handler($this->upload, $config,
				$this->view, 'signature');

		$this->pengelola->simpandata($data);
	}

	function hapusdata($account_id): void
	{
		$this->pengelola->hapusdata($account_id);
	}
	
	function search(): void
	{
		$search = $this->input->get('data_user');
		$segment = $this->uri->segment(2);
		$table = ucfirst($segment);
		$url = '';
		
		if ($segment == 'peminjam') {
			$url = 'account/peminjam/history/';
		}
		
		$this->pengelola->search($search, $table, $url);
	}
}

