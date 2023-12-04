<?php
defined('BASEPATH') or exit('No direct script access allowed');

abstract class BRoom_Libraries
{
  protected CI_Controller $CI;
  
  public function __construct()
  {
    $this->CI =& get_instance();
  }
}