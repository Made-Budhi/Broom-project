<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Maccount $account
 * @property CI_Session $session
 * @property CI_DB $db
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Encryption $encryption
 */
class Mpengelola extends CI_Model
{
	
	public function datasingkat(): array
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
	
	public function jejakreservasi($id): array
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
	
	public function tampildata(): array|string
	{
		$hasil = null;
		$query = $this->db->select()->from('Account')
				->join('Pimpinan',
						'Account.account_id = Pimpinan.account_id')->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$hasil[] = $row;
			}
		} else {
			$hasil = "";
		}
		return $hasil;
	}
	
	public function simpandata($data): void
	{
		// Retrieving data from user input post
		$this->load->library('encryption');
		$this->load->model('Maccount', 'account');

		$account_id = $this->input->post('account_id');
		$id = $this->input->post('id');
		$name = $this->input->post("name");
		$email = $this->input->post("email");
		$position = $this->input->post("position");
		$password = password_hash($this->input->post("password"), PASSWORD_DEFAULT);
		$signature = $data['image'];

		$enc_hash = $this->encryption->encrypt($password);

		if ($account_id == "") {
			// Insert data email, password, and generated token to table account
			$data = array(
					"account_id" => '',
					"email" => $email,
					"password" => $enc_hash,
					"role" => AccountRole::PIMPINAN,
					"is_verif" => 1
			);
			$this->account->checkDuplication($id, $email, AccountRole::PIMPINAN, 'account/pimpinan');
			$this->db->insert('Account', $data);
			
			// Build a variable to get account_id FROM table account
			$fkdata = $this->db->select()->from('Account')
					->where('email', $email)->where('password', $enc_hash)
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
		} else {
			// Update data email, password, and generated token to table account
			$account = $this->db->select('password')->from('Account')
					->where('account_id', $account_id)->get()->first_row();
			$data = array(
					"email" => $email,
					"password" => $account->password,
					"role" => AccountRole::PIMPINAN
			);
			$this->db->where('account_id', $account_id);
			$this->db->update('Account', $data);
			
			// Update data id, name, phone, & (account_id FROM variable $fkdata) TO table pimpinan
			$data = array(
					"id" => $id,
					"name" => $name,
					"position" => $position
			);
			$this->db->where('account_id', $account_id);
			$this->db->update('Pimpinan', $data);
			
			echo "<script>alert ('Data telah diedit');</script>";
		}
		redirect('account/pimpinan');
	}
	
	public function hapusdata($account_id): void
	{
		// Start a database transaction
		$this->db->trans_start();
		
		// Delete rows from the dependent table (pimpinan) first
		$this->db->delete('Pimpinan', array('account_id' => $account_id));
		
		// Now, delete the row from the main table (Account)
		$this->db->delete('Account', array('account_id' => $account_id));
		
		// Complete the transaction
		$this->db->trans_complete();
		
		// Check for transaction success
		if ($this->db->trans_status() === FALSE) {
			// Something went wrong, handle the error
			show_error('Error deleting data');
		} else {
			// Transaction was successful, redirect
			redirect('cpengelola/view_data_pimpinan', 'refresh');
		}
	}
	
	public function search($searchStr, $table, $url): void
	{
		$searchStr = str_replace('%20', ' ', $searchStr);
		
		$results = $this->db->select()->from($table)
				->like('name', $searchStr)
				->or_like('id', $searchStr)
				->or_like('phone', $searchStr)
				->get()->result();
		
		$result_html = function ($r, $d) {
			return peminjam_result_dropdown($r, $d);
		};
		
		$default_html = function () {
			return default_result_dropdown('No Result');
		};
		
		$head_result = function () {
			return peminjam_head_dropdown();
		};
		
		livesearch($searchStr, $results, $result_html, $default_html, $url, $head_result);
	}
}
