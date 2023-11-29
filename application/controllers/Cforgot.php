<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Maccount $account
 */
class Cforgot extends CI_Controller
{

	/**
	 * Calling model for verification
	 */
	function forgot(): void
  {
		$this->load->model("Maccount", 'account');
		$this->account->create_verification();
	}

}

