<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Maccount $account
 */

class Cregister extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Maccount', 'account');
  }
  
  public function register(): void
  {
    $this->account->register();
  }
  
  
}