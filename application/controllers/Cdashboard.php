<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property Mreservasi $reservasi
 * @property Mnotification $notification
 * @property CI_Session $session
 * @property CI_Loader $load
 */

class Cdashboard extends Broom_Controller
{
	private array $current_session;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mreservasi', 'reservasi');
		$this->load->model('Mnotification', 'notification');
		$this->current_session = $this->session->get_userdata();
	}

	public function index(): void
	{
		$role = $this->current_session['role'];
		$data = array();
		$view = array();
		
		// Determine which page should be loaded.
		// ps: we can use $data['hasil'] = array(); to store more than one value
		switch ($role) {
			case AccountRole::PEMINJAM:
				$data['hasil'] 		= $this->reservasi->tampildata('peminjam_id');
				$view['content'] 	= 'menu_peminjam/dashboard';
				$view['sidebar'] 	= 'layouts/sidebar';
				break;

			case AccountRole::PIMPINAN:
				$data['hasil'] 		= $this->reservasi->get_data_assigned();
				$view['content'] 	= 'menu_pimpinan/dashboard';
				$view['sidebar'] 	= 'layouts/sidebar_pimpinan';
				break;

			case AccountRole::PENGELOLA:
				redirect('notifications');
				break;
		}
		
		$html['current_uri'] = "dashboard";
		$data['sessions'] = $this->session->userdata;
		$html['content'] = $this->load->view($view['content'], $data, true);
		$this->load->view($view['sidebar'], $html);
	}
}
