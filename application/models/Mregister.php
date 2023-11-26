<?php

class Mregister extends CI_Model 
{
    /**
	 * For registration user with input data.
	 *
	 * @return void
	 */  
    public function regis()
    {

        // Retrieving data from user input post
        $email = $this->input->post("email");
        $password = $this->input->post("password");
        $id = $this->input->post('id');
        $name = $this->input->post("name");
        $phone = $this->input->post("phone");

        // Insert data email & password into DATABASE table account
        $this->db->insert('account',array("email"=>$email,"password"=>$password,"role"=>"Peminjam"));

        // Build a variable to get account_id FROM table account
        $where = "`email` = '" . $email . "' AND `password` = '" . $password . "'";
        $fkdata = $this->db->select()->from('account')->where($where)->get()->first_row();
        $fkid = $fkdata->account_id;

        // Insert data id, name, phone, & (account_id FROM variable $fkdata) TO table peminjam
        $this->db->insert('peminjam',array("id"=>$id,"name"=>$name,"phone"=>$phone,"role"=>"Mahasiswa","account_id"=>$fkid));

        echo "<script>alert('Data sudah disimpan, Silahkan Verifikasi');</script>";

    }
    
}

?>