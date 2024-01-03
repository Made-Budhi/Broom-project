<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property Mreservasi $reservasi
 * @property Mnotification $notification
 * @property CI_Session $session
 * @property CI_Loader $load
 */

class Cdashboard extends CI_Controller
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
		// TODO: change the correct view to corresponding role
		// ps: we can use $data['hasil'] = array(); to store more than one value
		switch ($role) {
			case 'Peminjam':
				$data['hasil'] 		= $this->reservasi->tampildata('peminjam_id');
				$view['content'] 	= 'menu_peminjam/dashboard';
				$view['sidebar'] 	= 'layouts/sidebar';
			break;

			case 'Pimpinan':
				$data['hasil'] 		= $this->reservasi->get_data_assigned();
				$view['content'] 	= 'menu_pimpinan/dashboard';
				$view['sidebar'] 	= 'layouts/sidebar_pimpinan';
			break;

			case 'Pengelola':
				$this->load->language('BRoomNotification');

				$data['hasil']		= array(
					'notifikasi'	=> $this->notification->getPengelolaNotification(),
					'message'		=> $this->lang->line('notification_empty')
				);
				$view['content'] 	= 'menu_pengelola/notification';
				$view['sidebar'] 	= 'layouts/sidebar_pengelola';
			break;

			default:
				// TODO: direct to login views & give warn
			break;
		}

		$data['sessions'] = $this->session->userdata;
		$html['content'] = $this->load->view($view['content'], $data, true);
		$this->load->view($view['sidebar'], $html);
	}
}
