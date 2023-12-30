<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Controller $CI
 * @property CI_Email $email
 * @property CI_Config $config
 * @property CI_Lang $lang
 * @property CI_Session $session
 */
abstract class BRoom_Libraries
{
	public function __construct()
	{
		$this->CI = &get_instance();
		$this->email = &load_class('Email');
		$this->config = &load_class('Config', 'core');
		$this->lang = &load_class('Lang', 'core');
		
		if (isset($this->CI->session)) {
			$this->session = $this->CI->session;
		}
	}
}