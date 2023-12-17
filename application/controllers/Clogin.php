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
	 * Calling model method for login authentication
	 * and determine which page should be loaded after
	 * successful login process corresponds to user's role.
	 *
	 * @return void
	 */
	function loginauth(): void
	{
		$this->account->login();
    	redirect('Cdashboard', 'refresh');
	}
}
