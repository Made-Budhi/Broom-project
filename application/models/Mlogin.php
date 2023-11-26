<?php

class Mlogin extends CI_Model
{
	/**
	 * For authenticating login sent by user.
	 *
	 * @return void
	 */
	function loginauth()
	{
		// Retrieving data from user input post
		$email		= $this->input->post('email');
		$password 	= $this->input->post('password');

		// WHERE syntax
		$where = "`email` = '" . $email . "' AND `password` = '" . $password . "'";

		// Fetching from database
		$data = $this->db->select()->from('account')->where($where)->get();

		/*
		 * Checking whether the data exists or not.
		 * If exist		= identifies role -> join table account with related role -> set session
		 * If not		= login authentication failed
		 */
		if ($data->num_rows() > 0) {
			echo "Data found!";

			$accountData = $data->first_row();

			// Join table account with related role
			$roleData = $this->db->select()->from($accountData->role)->join(
				'account',
				"account.account_id = " . $accountData->role .".account_id",
				'inner'
			)->get()->first_row();


			// Setting session with role & id
			$sessionData = array(
				'id'	=> $roleData->id,
				'role'	=> $roleData->role
			);

			$this->session->set_userdata($sessionData);
		}
		else {
			$this->session->set_flashdata('loginerror', 'Invalid e-mail or password.');
			redirect(base_url());
		}

	}
}
