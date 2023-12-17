<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Mrooms $rooms
 */
class Crooms extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Mrooms", "rooms");
	}

	function index(): void
	{
		$tampilgedung['hasil'] = $this->rooms->tampilgedung();
		$data['konten'] = $this->load->view("menu_peminjam/roomlist", $tampilgedung, TRUE);
		$this->load->view("layouts/sidebar", $data);
	}

	function calendar($id): void
	{
		$tampildata['hasil'] = $this->rooms->tampildata($id);
		$data = array(
			'tabel' => $this->load->view('menu_peminjam/schedule', $tampildata, TRUE),
			'id' => $id
		);

		$data['konten'] = $this->load->view('menu_peminjam/calendar', $data, true);
		$this->load->view('layouts/sidebar', $data);
	}

	function view(): void
	{
		$data = array(
			'id' => $this->input->get('id')
		);

		$data['konten'] = $this->load->view('menu_peminjam/calendar', $data, true);
		$this->load->view('layouts/sidebar', $data);
	}
}
