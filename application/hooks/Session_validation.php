<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Loader $load
 * @property Broom_Authentication $authentication
 */
class Session_validation
{
	public function __construct()
	{
		$this->load->library('accounts/Broom_Authentication', null, 'authentication');
	}
	
	public function __get($property)
	{
		if (!property_exists(get_instance(), $property))
		{
			show_error('property: <strong>' .$property . '</strong> not exist.');
		}
		
		return get_instance()->$property;
	}
	
	public function check_session_log_in(): void
	{
		if ( ! $this->authentication->isSessionValid())
		{
			redirect(site_url());
		}
	}
	
	public function check_session_log_out(): void
	{
		if ($this->authentication->isSessionValid()) {
			redirect('dashboard');
		}
	}
}