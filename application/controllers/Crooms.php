<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Mrooms $rooms
 * @property CI_Input $input
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
}
