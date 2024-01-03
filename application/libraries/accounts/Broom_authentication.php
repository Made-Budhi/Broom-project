<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/core/BRoom_Libraries.php';

class Broom_Authentication extends BRoom_Libraries
{
	public function isSessionValid(): bool
	{
		return $this->session->has_userdata('id');
	}
}