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

		$session = $this->session->get_userdata();

		// Determine which page should be loaded.
		switch ($session['role']) {
			case 'Peminjam':
				$this->load->view('peminjam_mainviews'); // TODO: change the correct view to corresponding role
			break;

			case 'Pimpinan':
				$this->load->view('pimpinan_mainviews'); // TODO: change the correct view to corresponding role
			break;

			case 'Pengelola':
				$this->load->view('pengelola_mainviews'); // TODO: change the correct view to corresponding role
			break;

		}
	}
}
