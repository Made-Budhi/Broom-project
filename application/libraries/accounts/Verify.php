<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
  
  public function send_email(string $email, string &$token): bool
  {
    $this->CI->email->initialize($this->config);
    $this->CI->email
      ->from($this->config['from'], $this->config['name']);
    $this->CI->email->to($email);
    $this->CI->email
      ->subject($this->CI->lang->line('email_verification_subject'));
    $this->CI->email
      ->message($this->CI->lang->line('email_verification_messages'));
    
    $send_status = $this->CI->email->send();
    $token = $this->generate_token();
    
    if (!$send_status) {
      log_message('info', $this->CI
        ->lang->line('log_send_email_failed')
      );
    } else {
      log_message('info', $this->CI
        ->lang->line('log_send_email_succeed')
      );
    }
    
    return $send_status;
  }
  
  private function generate_token(): string
  {
    return str_shuffle(uniqid());
  }
}