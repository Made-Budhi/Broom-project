<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Mnotification $notification
 * @property CI_Lang $lang
 */

class Cnotification extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mnotification', 'notification');
	}
	
	function index(): void
	{
		$this->load->language('BRoomNotification');
		
		$data['notifikasi'] = $this->notification->getNotification();
		$data['message']	= $this->lang->line('notification_empty');
		
		$html['content'] = $this->load->view('menu_peminjam/notification', $data, true);
		$this->load->view('layouts/sidebar', $html);
	}

	function peminjam_notification()
	{
		$this->load->language('BRoomNotification');

		$data['notifikasi'] = $this->notification->getNotification();
		$data['message']	= $this->lang->line('notification_empty');

		$html['content'] = $this->load->view('menu_peminjam/notification', $data, true);
		$this->load->view('layouts/sidebar', $html);
	}

	function pimpinan_notification()
	{
		$this->load->language('BRoomNotification');

		$data['notifikasi'] = $this->notification->getPemimpinNotification();
		$data['message']	= $this->lang->line('notification_empty');

		$html['content'] = $this->load->view('menu_pimpinan/notification', $data, true);
		$this->load->view('layouts/sidebar_pimpinan', $html);
	}
}
