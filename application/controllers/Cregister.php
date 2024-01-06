<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Maccount $account
 */
class Cregister extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Maccount', 'account');
	}
	
	public function add(): void
	{
		$this->account->register();
		redirect(site_url(), 'refresh');
	}
	
	public function auth($case, $auth_token = ''): void
	{
		if ($case == 'email') {
			if ( ! empty($auth_token)) {
				$this->account->verify_email($auth_token);
			}
		}
		
		redirect(site_url());
	}
	
	function index(): void
	{
		$this->load->view('menu_autentikasi/register');
	}
}