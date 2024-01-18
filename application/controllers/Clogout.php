<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Maccount $account
 */
class Clogout extends Broom_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Maccount', 'account');
	}
	
	function index(): void
	{
		$this->account->logout();
		redirect(site_url());
	}
}