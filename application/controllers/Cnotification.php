<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Mnotification $notification
 * @property CI_Lang $lang
 * @property CI_Session $session
 */

class Cnotification extends Broom_Controller
{
	private array $current_session;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mnotification', 'notification');
		$this->load->language('BRoomNotification');
		$this->current_session = $this->session->get_userdata();
	}
	
	function index(): void
	{
		$role = $this->current_session['role'];
		$data = array();
		$view = array();
		
		// Determine which page should be loaded.
		// ps: we can use $data['hasil'] = array(); to store more than one value
		switch ($role) {
			case AccountRole::PEMINJAM:
				$view['content'] 	= 'menu_peminjam/notification';
				$view['sidebar'] 	= 'layouts/sidebar';
				break;
			
			case AccountRole::PIMPINAN:
				$view['content'] 	= 'menu_pimpinan/notification';
				$view['sidebar'] 	= 'layouts/sidebar_pimpinan';
				break;
			
			case AccountRole::PENGELOLA:
				$view['content'] 	= 'menu_pengelola/notification';
				$view['sidebar'] 	= 'layouts/sidebar_pengelola';
				break;
		}
		
		$html['current_uri'] = "notifikasi";
		$data['notifikasi'] = $this->notification->getNotification();
		$data['message'] = $this->lang->line('notification_empty');
		$html['content'] = $this->load->view($view['content'], $data, true);
		$this->load->view($view['sidebar'], $html);
	}
}
