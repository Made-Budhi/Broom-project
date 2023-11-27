<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Mregister $mregister
 */

class Cregister extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('mregister');
  }
  
  public function register(): void
  {
    $this->mregister->regis();
  }
  
  
}