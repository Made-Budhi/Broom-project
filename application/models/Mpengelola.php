<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_DB $db
 */

 class Mpengelola extends CI_Model
 {
	 
	 function datasingkat()
	 {
		 $hasil = array();
		 
		 $query = $this->db->select()->from("Peminjam")
				 ->get();
		 
		 // to check query database
		 foreach ($query->result() as $row) {
			 $hasil[] = $row;
		 }
		 return $hasil;
	 }
	 
	 function jejakreservasi($id)
	 {
		 $hasil = array();
		 $query = $this->db->select('*,
		Reservasi.status as reservasi_status'
		 )->from('Reservasi')
				 ->join(
						 "Ruangan",
						 "Reservasi.ruangan_id = Ruangan.id",
						 "inner"
				 )
				 ->where('Reservasi.peminjam_id', $id)->get();
		 
		 foreach ($query->result() as $row) {
			 $hasil[] = $row;
		 }
		 
		 // return variable to get database
		 return $hasil;
	 }

	 function tampildata()
		{
			$sql="SELECT * FROM Account JOIN Pimpinan ON Account.account_id = Pimpinan.account_id;";
			$query=$this->db->query($sql);
			if ($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$hasil[]=$row;
				}	
			}
			else
			{
				$hasil="";	
			}
			return $hasil;	
		}

	public function simpandata($data): void
	{
		// Retrieving data from user input post
		$account_id = $this->input->post('account_id');
		$id = $this->input->post('id');
		$name = $this->input->post("name");
		$email = $this->input->post("email");
		$position = $this->input->post("position");
		$password = $this->input->post("password");
		$signature = $data['image'];
		$token = '';
		
		if($account_id=="") {
			// Insert data email, password, and generated token to table account
			$data = array(
					"email" => $email,
					"password" => $password,
					"token" => $token,
					"role" => AccountRole::PIMPINAN,
					"is_verif" => 1
			);
			unset($token);
			$this->db->insert('Account', $data);
			
			// Build a variable to get account_id FROM table account
			$fkdata = $this->db->select()->from('Account')
					->where('email', $email)->where('password', $password)
					->get()->first_row();
			$fkid = $fkdata->account_id;
			
			// Insert data id, name, phone, & (account_id FROM variable $fkdata) TO table pimpinan
			$data = array(
					"id" => $id,
					"name" => $name,
					"position" => $position,
					"account_id" => $fkid,
					"signature" => $signature
			);
			$this->db->insert('Pimpinan', $data);
			
			echo "<script>alert ('data telah disimpan');</script>";
			redirect(site_url('cpengelola/view_data_pimpinan'));
		} else {
			// Update data email, password, and generated token to table account
			$data = array(
				"email" => $email,
				"password" => $password,
				"token" => $token,
				"role" => AccountRole::PIMPINAN
			);
			unset($token);
			$this->db->where('account_id',$account_id);
			$this->db->update('Account', $data);
		
			// Update data id, name, phone, & (account_id FROM variable $fkdata) TO table pimpinan
			$data = array(
				"id" => $id,
				"name" => $name,
				"position" => $position,
				"signature" => $data['image']
			);
			$this->db->where('account_id', $account_id);
			$this->db->update('Pimpinan', $data);
			
			echo "<script>alert ('Data telah diedit');</script>";
			redirect(site_url('cpengelola/view_data_pimpinan'));	
		}	
	}

	public function hapusdata($account_id)
	{
		// Start a database transaction
		$this->db->trans_start();

		// Delete rows from the dependent table (pimpinan) first
		$this->db->delete('pimpinan', array('account_id' => $account_id));

		// Now, delete the row from the main table (Account)
		$this->db->delete('Account', array('account_id' => $account_id));

		// Complete the transaction
		$this->db->trans_complete();

		// Check for transaction success
		if ($this->db->trans_status() === FALSE) {
			// Something went wrong, handle the error
			show_error('Error deleting data', 500);
		} else {
			// Transaction was successful, redirect
			redirect('cpengelola/view_data_pimpinan','refresh');
		}
	}
 }
 