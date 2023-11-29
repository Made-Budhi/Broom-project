<?php

/**
 * @property BRoom_Verify $account_verify
 */

class Mregister extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('accounts/BRoom_Verify', null, 'account_verify');
  }
  
  /**
   * For registration user with input data.
   *
   * @return void
   */
  public function regis(): void
  {
    // Retrieving data from user input post
    $email = $this->input->post("email");
    $password = $this->input->post("password");
    $id = $this->input->post('id');
    $name = $this->input->post("name");
    $phone = $this->input->post("phone");
    $token = '';
    
    // Insert data email, password, and generated token to table account
    $this->account_verify->send_email($email, $token);
    $data = array(
      "email"     => $email,
      "password"  => $password,
      "token"     => $token,
      "role"      => "Peminjam"
    );
    $this->db->insert('account', $data);
    
    // Build a variable to get account_id FROM table account
    $fkdata = $this->db->select()
      ->from('account')
      ->where('email', $email)->where('password', $password)
      ->get()->first_row();
    $fkid = $fkdata->account_id;
    
    // Insert data id, name, phone, & (account_id FROM variable $fkdata) TO table peminjam
    $data = array(
      "id"=>$id,
      "name"=>$name,
      "phone"=>$phone,
      "role"=>"Mahasiswa",
      "account_id"=>$fkid
    );
    $this->db->insert('peminjam', $data);
    
    echo "<script>alert('Data sudah disimpan, Silahkan Verifikasi');</script>";
  }
}