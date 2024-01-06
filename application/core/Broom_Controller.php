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
		$this->hooks->call_hook('session_check');
	}
	
}