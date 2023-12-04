<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'libraries/core/BRoom_Libraries.php';

class BRoom_Verify extends BRoom_Libraries
{
  private array $config;
  
  public function __construct()
  {
    parent::__construct();
    $this->CI->load->config('BRoom/EmailVerify');
    
    // Todo must implement non hardcoded parameter
    $this->CI->load->language(array('BRoomLogging', 'BRoomEmail'), 'english');
    
    $this->config = $this->CI->config->config;
  }
  
  /**
   * @param string $email
   * @param string $token
   * @param bool $is_otp
   * @return bool
   */
  public function send_email(string $email, string &$token,
                             bool $is_otp = false): bool
  {
    $this->CI->email->initialize($this->config);
    $this->CI->email
      ->from($this->config['from'], $this->config['name']);
    $this->CI->email->to($email);
    $this->CI->email
      ->subject($this->CI->lang->line('email_verification_subject'));
    $this->CI->email
      ->message($this->CI->lang->line('email_verification_messages'));
    
    $token = $is_otp?
      $this->_create_random('otp') : $this->_create_random('token');
    
    $send_status = $this->CI->email->send();
    
    if (!$send_status) {
      log_message('debug', $this->CI
        ->lang->line('log_send_email_failed')
      );
    } else {
      log_message('debug', $this->CI
        ->lang->line('log_send_email_succeed')
      );
    }
    
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