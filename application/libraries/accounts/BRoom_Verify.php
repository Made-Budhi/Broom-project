<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/core/BRoom_Libraries.php';

class BRoom_Verify extends BRoom_Libraries
{
	private array $configs;
	
	public function __construct()
	{
		parent::__construct();
		$this->config->load('BRoom/EmailVerify');
		
		// Todo must implement non hardcoded parameter
		$this->lang->load(array('BRoomLogging', 'BRoomEmail'), 'english');
		
		$this->configs = $this->config->config;
	}
	
	/**
	 * @param string $email
	 * @param string $token
	 * @param bool $is_otp
	 * @return bool
	 */
	public function send_email(string $email, string &$token,
							   bool   $is_otp = false): bool
	{
		$this->email->initialize($this->configs);
		$this->email
				->from($this->configs['from'], $this->configs['name']);
		$this->email->to($email);
		$this->email->subject($this->lang->line('email_verification_subject'));
		$this->email->message($this->CI->load
				->view('layouts/email', null, true));
		
		$token = $is_otp ?
				$this->_create_random('otp') : $this->_create_random('token');
		
		$send_status = $this->email->send();
		
		if (!$send_status) {
			$msg = $this->lang->line('log_send_email_failed');
			$this->session->set_flashdata('error', $msg);
			log_message('debug', $msg);
			redirect('login/forgot/password');
		}
		
		log_message('debug', $this->lang->line('log_send_email_succeed'));
		return $send_status;
	}
	
	private function _create_random(string $type): string|bool
	{
		$type = strtolower($type);
		$value = null;
		
		if ($type === 'otp') {
			try {
				// random_int() are from PHP 7.0, beware for old project
				$value = strval(random_int(100000, 999999));
			} catch (Exception) {
				return false;
			}
		} elseif ($type === 'token') {
			$value = substr(str_shuffle(uniqid()), 0, 6);
		}
		
		return $value;
	}
}