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
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Mrooms", "rooms");
	}

	function index(): void
	{
		// TODO separate rooms controller each role
		$tampilgedung['hasil'] = $this->rooms->tampilgedung();
		$html['content'] = $this->load->view("menu_peminjam/roomlist", $tampilgedung, TRUE);
		$html['current_uri'] 	= "ruangan";
		$this->load->view("layouts/sidebar", $html);
	}

	function calendar($id): void
	{
		$tampildata['hasil'] = $this->rooms->tampildata($id);
		$data = array(
			'tabel' => $this->load->view('menu_peminjam/schedule', $tampildata, TRUE),
			'id' => $id
		);

		$data['content'] = $this->load->view('menu_peminjam/calendar', $data, true);
		$this->load->view('layouts/sidebar', $data);
	}

	function view(): void
	{
		$data = array(
			'id' => $this->input->get('id')
		);

		$data['content'] = $this->load->view('menu_peminjam/calendar', $data, true);
		$this->load->view('layouts/sidebar', $data);
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
