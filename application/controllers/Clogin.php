<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Maccount $account
 * @property CI_Session $session
 * @property CI_Input $input
 */
class Clogin extends Broom_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_check_is_logged_out();
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
	 * @param string|null $case
	 * @param null $code
	 * @return void
	 */
	function auth(?string $case = '', $code = null): void
	{
		switch ($case) {
			// Determines the validity of the otp code
			case 'otp':
				if($this->session->userdata('token') === $this->input
								->post('token')) {
					$this->load->view('reset');
					$this->session->set_tempdata('otp_is_verified', true,
							3600);
					redirect('login/reset');
				} else {
					// TODO need implement language
					$this->session->set_flashdata('otp_invalid','Kode OTP tidak valid');
					redirect('login/forgot/otp', 'refresh');
				}
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
			case 'otp':
				if ( ! $this->session->has_userdata('has_verification')) {
					$this->account->create_verification();
				}
				$this->load->view('otp');
				break;
			
			default:
				$this->load->view('forgot_password');
				break;
		}
	}
	
	public function reset(): void
	{
		/*
		 * Checking whether the otp is the correct one or not.
		 * If correct		= go to reset password page
		 * If not			= go back to otp input page
		 */
		if($this->session->has_userdata('otp_is_verified')) {
			$this->load->view('reset');
		} else {
			redirect('login');
		}
	}
	
	public function change_password(): void
	{
		if ($this->session->has_userdata('otp_is_verified')) {
			$this->session->sess_destroy();
			$this->account->newpass($this->input->post('password'));
		}
	}
}
