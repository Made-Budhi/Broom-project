<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Mrooms $rooms
 * @property Mreservasi $reservasi
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
		$this->_check_is_logged_in();
		$this->load->model("Mrooms", "rooms");
		$this->load->model('Mreservasi', 'reservasi');
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

	function room_schedule(): void
	{
		$id = $this->input->post('ruangan');
		$date = $this->input->post('date');

		$data = $this->reservasi->get_reservation($id, $date);

		if (!empty($data)) {
			$data[0]->date_start = format_indo($data[0]->date_start);
			$data[0]->date_end = format_indo($data[0]->date_end);
		}

		echo json_encode($data);
	}

	function detailrooms(): void
	{
		$id = $this->input->get('id');

		$this->data['ruangan'] 		= $this->rooms->tampilgedung($id);
		$this->data['reservasi']	= $this->reservasi->getAllRuanganReservation($id);

		$this->html['content'] = $this->load->view('menu_peminjam/calendar', $this->data, true);
		$this->load->view($this->view['sidebar'], $this->html);
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
	
	function change(): void
	{
		$data['id'] = $this->input->post('id_room');
		
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
		
		if (empty($data['image'])) {
			$data['image'] = $this->input->post('img_name');
		}
		$this->rooms->edit_room($data);

		redirect('rooms/detailrooms?id='.$data['id']);
	}
	
	function delete($id): void
	{
		if ($this->session->get_userdata()['role'] != AccountRole::PENGELOLA) {
			redirect('dashboard');
		}
		
		$this->rooms->delete_rooom($id);
		
		redirect('rooms');
	}
	
}
