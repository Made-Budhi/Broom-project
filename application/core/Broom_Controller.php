<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Hooks $hooks
 */
class Broom_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->hooks =& load_class('Hooks', 'core');
	}
	
	protected function _check_is_logged_in(): void
	{
		$this->hooks->call_hook('session_login_check');
	}
	
	protected function _check_is_logged_out(): void
	{
		$this->hooks->call_hook('session_logout_check');
	}
	
}