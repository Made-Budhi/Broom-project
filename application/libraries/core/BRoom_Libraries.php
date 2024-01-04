<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Email $email
 * @property CI_Config $config
 * @property CI_Lang $lang
 * @property CI_Session $session
 */
abstract class BRoom_Libraries
{
	protected CI_Controller $CI;
	
	public function __construct()
	{
		$this->CI = &get_instance();
	}
	
	public function __get(string $name)
	{
		if (!property_exists($this->CI, $name)) {
			show_error('property: <strong>' .$name . '</strong> not exist.');
		}
		
		return $this->CI->$name;
	}
}