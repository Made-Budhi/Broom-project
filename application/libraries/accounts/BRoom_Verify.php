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
	 * @param &$token
	 * @param bool $is_otp
	 * @return bool
	 */
	public function send_email(string $email, &$token,
							   bool   $is_otp = false): bool
	{
		$this->email->initialize($this->configs);
		$this->email
				->from($this->configs['from'], $this->configs['name']);
		$this->email->to($email);
		
		if ($is_otp) {
			$token = $this->_create_random(Verification::OTP);
			$this->email->subject($this->lang
					->line('email_verification_otp'));
			$data['type'] = Verification::OTP;
		} else {
			$token = $this->_create_random(Verification::REGISTER);
			$this->email->subject($this->lang
					->line('email_verification_register'));
			$data['type'] = Verification::REGISTER;
		}
		$data['code'] = $token;
		
		$this->email->message($this->CI->load
				->view('layouts/email', $data, true));
		
		$send_status = $this->email->send();
		
		if (!$send_status) {
			$msg = $this->lang->line('log_send_email_failed');
			$this->session->set_flashdata('error', $msg);
			log_message('debug', $msg);
			redirect('login/forgot');
		}
		
		log_message('debug', $this->lang->line('log_send_email_succeed'));
		return $send_status;
	}
	
	private function _create_random($type): string|bool
	{
		$value = null;
		
		if ($type === Verification::OTP) {
			try {
				// random_int() are from PHP 7.0, beware for old project
				$value = strval(random_int(100000, 999999));
			} catch (Exception) {
				return false;
			}
		} elseif ($type === Verification::REGISTER) {
			$value = substr(str_shuffle(uniqid()), 0, 6);
		}
		
		return $value;
	}
}