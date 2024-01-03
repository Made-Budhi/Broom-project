<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Mnotification $notification
 */

class Cnotification extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mnotification', 'notification');
		$this->load->language('BRoomNotification');
	}

	function peminjam_notification()
	{
		$data['notifikasi'] = $this->notification->getPeminjamNotification();
		$data['message']	= $this->lang->line('notification_empty');

		$html['content'] = $this->load->view('menu_peminjam/notification', $data, true);
		$this->load->view('layouts/sidebar', $html);
	}

	function pimpinan_notification()
	{
		$data['notifikasi'] = $this->notification->getPemimpinNotification();
		$data['message']	= $this->lang->line('notification_empty');

		$html['content'] = $this->load->view('menu_pimpinan/notification', $data, true);
		$this->load->view('layouts/sidebar_pimpinan', $html);
	}

	function pengelola_notification()
	{
		$this->load->language('BRoomNotification');

		$data['notifikasi'] = $this->notification->getPengelolaNotification();
		$data['message']	= $this->lang->line('notification_empty');

		$html['content'] = $this->load->view('menu_pengelola/notification', $data, true);
		$this->load->view('layouts/sidebar_pengelola', $html);
	}
}
