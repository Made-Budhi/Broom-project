<?php

/**
 * @property BRoom_Verify $account_verify
 */

class Mregister extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('accounts/Verify', null, 'account_verify');
  }
  
  public function regis(): void
  {
    $email = $this->input->post("email");
    
    $this->account_verify->send_email($email, $token);
    echo $token;
  }
}