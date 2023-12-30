<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Maccount $account
 */
class Clogin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Maccount', 'account');
	}
	
	/**
	 * Loading login page.
	 *
	 * @return void
	 */
	function index(): void
	{
		$this->load->view('menu_autentikasi/login');
	}
	
	/**
	 * Calling model method for login authentication
	 * and determine which page should be loaded after
	 * successful login process corresponds to user's role.
	 *
	 * @param null $case
	 * @return void
	 */
	function auth($case = null): void
	{
		switch ($case) {
			case 'otp':
				$this->account->create_verification();
				redirect(site_url());
				break;
			
			default:
				$this->account->login();
				redirect('dashboard', 'refresh');
				break;
		}
	}
	
	/**
	 * Load input email form for forgot
	 * password mechanism.
	 *
	 * @param $case
	 * @return void
	 */
	function forgot($case = null): void
	{
		switch ($case) {
			case 'password':
				$this->load->view('email');
				break;
			
			default:
				show_404();
				break;
		}
	}
	
	function logout(): void
	{
		$this->account->logout();
		redirect(site_url());
	}
}
