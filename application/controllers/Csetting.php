<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Maccount $account
 */

class Csetting extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Maccount', 'account');
  }
  
  public function index(): void
  {
    $html['settings_views'] = $this->load->view('settings/index', '', true);
    $this->load->view('layouts/sidebar', $html);
  }
  
  public function profile_edit_view(): void
  {
    $data['account'] = $this->account->get_current_account_data();
    $this->load->view('settings/profile_edit', $data);
  }
  
  public function profile_preference_view(): void
  {
    $this->load->view('settings/profile_preference');
  }
  
  public function get_support_view(): void
  {
    $this->load->view('settings/support');
  }
  
  public function profile_edit(): void
  {
    // <input> tags MUST NOT HIDDEN, check javascript logic-
    // in case this not working
    $data = $this->input->post(null, true);
    $this->account->edit($data);
    
    redirect(site_url('settings'), 'refresh');
  }
}