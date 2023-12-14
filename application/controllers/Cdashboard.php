<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property Mreservasi $reservasi
 */

class Cdashboard extends CI_Controller
{
	private array $current_session;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mreservasi', 'reservasi');
		$this->current_session = $this->session->get_userdata();
	}

	public function index(): void
	{
		$role = $this->current_session['role'];

		// Determine which page should be loaded.
		// TODO: change the correct view to corresponding role
		switch ($role) {
			case 'Peminjam':
				$data['hasil'] = $this->reservasi->tampildata();
				$view = 'menu_peminjam/dashboard';
			break;

			case 'Pimpinan':
				$data[] = '';
				$view = '';
			break;

			case 'Pengelola':
				$view = '';
			break;

			default:
				// TODO: direct to login views & give warn
			break;
		}

//		$view = match ($this->current_session['role']) {
//			'Peminjam' => 'menu_peminjam/dashboard',
//
//			'Pimpinan' => 'pimpinan_mainviews',
//
//			'Pengelola' => 'pengelola_mainviews'
//		};

		$data['sessions'] = $this->session->userdata;
		$html['roles_views'] = $this->load->view($view, $data, true);
		$this->load->view('layouts/sidebar', $html);
	}
}
