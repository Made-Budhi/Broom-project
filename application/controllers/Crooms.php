<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Mrooms $rooms
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Upload $upload
 */
class Crooms extends Broom_Controller
{
	private array $current_session;
	private array $data = array();
	private array $view = array();
	private array $html = array('current_uri' => 'ruangan');

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Mrooms", "rooms");
		$this->current_session = $this->session->get_userdata();
		
		$role = $this->current_session['role'];
		
		// Determine which page should be loaded.
		switch ($role) {
			case AccountRole::PEMINJAM:
				$this->data['hasil'] = $this->rooms->tampilgedung();
				$this->view['content'] = 'menu_peminjam/roomlist';
				$this->view['sidebar'] = 'layouts/sidebar';
				break;
			
			case AccountRole::PIMPINAN:
				redirect('dashboard');
				break;
			
			case AccountRole::PENGELOLA:
				$this->data['hasil'] = $this->rooms->tampilgedung();
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

	function calendar($id): void
	{
		$tampildata['hasil'] = $this->rooms->tampildata($id);
		$this->data = array(
			'tabel' => $this->load->view('menu_peminjam/schedule', $tampildata, TRUE),
			'id' => $id
		);

		$this->data['content'] = $this->load
				->view('menu_peminjam/calendar', $this->data, true);
		$this->load->view($this->view['sidebar'], $this->data);
	}

	function view(): void
	{
		$this->data = array(
			'id' => $this->input->get('id')
		);

		$this->data['content'] = $this->load
				->view('menu_peminjam/calendar', $this->data, true);
		$this->load->view($this->view['sidebar'], $this->data);
	}
	
	function search(): void
	{
		$search = $this->input->get('room_name');
		$this->rooms->search($search);
	}
	
	function add(): void
	{
		if (empty($this->input->post())) {
			redirect('rooms');
			return;
		}
		
		// Upload room image
		$config = array(
				'upload_path' 	=> FCPATH.'assets/images/ruangan/',
				'allowed_types' => 'jpg|png',
				'max_size' 		=> 0,
				'max_width'		=> 0,
				'max_height'	=> 0
		);
		
		$this->load->library('upload', $config);
		$data['image'] = upload_handler($this->upload, $config,
				$this->view, 'image');
		
		$this->rooms->add_room($data);
		
		redirect('rooms');
	}
	
}
