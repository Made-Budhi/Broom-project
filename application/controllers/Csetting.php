<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property CI_Session $session
 * @property Maccount $account
 */
class Csetting extends Broom_Controller
{
	
	private array $current_session;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Maccount', 'account');
		$this->current_session = $this->session->get_userdata();
	}
	
	public function index(): void
	{
		$role = $this->current_session['role'];
		
		// Determine which page should be loaded.
		// TODO: change the correct view to corresponding role

		$view['sidebar'] = match ($role) {
			'Peminjam' => 'layouts/sidebar',
			'Pimpinan' => 'layouts/sidebar_pimpinan',
			'Pengelola' => 'layouts/sidebar_pengelola'
		};
		
		$data['sessions'] = $this->session->userdata;
		$html['content'] = $this->load->view('settings/index', $data, true);
		$html['current_uri'] 	= "pengaturan";
		$this->load->view($view['sidebar'], $html);
	}
	
	public function profile_edit_view(): void
	{
		$data['account'] = $this->account->get_current_account_data();
		$this->load->view('settings/profile_edit', $data);
	}
	
	public function profile_preference_view(): void
	{
		$this->load->view('settings/profile_preference');
	}
	
	public function get_support_view(): void
	{
		$this->load->view('settings/support');
	}
	
	public function profile_edit(): void
	{
		// <input> tags MUST NOT HIDDEN, check javascript logic-
		// in case this not working
		$data = $this->input->post(null, true);
		$this->account->edit($data);
		
		redirect(site_url('settings'), 'refresh');
	}
}
