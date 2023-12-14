<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cdashboard extends CI_Controller
{
	private array $current_session;

	public function __construct()
	{
		parent::__construct();
		$this->current_session = $this->session->get_userdata();
	}

	public function index(): void
	{
		// Determine which page should be loaded.
		// TODO: change the correct view to corresponding role
		$view = match ($this->current_session['role']) {
			'Peminjam' => 'menu_peminjam/dashboard',

			'Pimpinan' => 'pimpinan_mainviews',

			'Pengelola' => 'pengelola_mainviews'
		};

		$data['sessions'] = $this->session->userdata;
		$html['roles_views'] = $this->load->view($view, $data, true);
		$this->load->view('layouts/sidebar', $html);
	}
}
