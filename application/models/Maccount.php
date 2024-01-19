<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property BRoom_Verify $account_verify
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_DB $db
 * @property CI_Lang $lang
 * @property CI_Encryption $encryption
 */
class Maccount extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('accounts/BRoom_Verify', null, 'account_verify');
		$this->load->library('encryption');
		// TODO must add language mechanism
		$this->load->language('BRoomAuth', 'indonesia');
	}
	
	/**
	 * For authenticating login sent by user.
	 *
	 * @return void
	 */
	public function login(): void
	{
		// Retrieving data from user input post
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
		// Fetching from database
		$data = $this->db->select()->from('Account')
				->where('email', $email)->get()->first_row();
		
		$decrypted_hash = $this->encryption->decrypt($data->password);
		
		/*
		 * Checking whether the data exists or not.
		 * If exist     = identifies role -> join table account with related
		 *                role -> set session
		 * If not       = login authentication failed
		 */
		if (!empty($data) && password_verify($password, $decrypted_hash)) {
			if (!$data->is_verif) {
				$this->session->set_flashdata(
						'login_error',
						$this->lang->line('email_not_verified')
				);
				redirect(site_url());
			}
			
			// Join table account with related role
			$roleData = $this->db->select()->from($data->role)->join(
					'Account',
					"Account.account_id = " . $data->role .
					".account_id",
					'inner'
			)->where('Account.account_id', $data->account_id)->get()
					->first_row();
			
			// Setting session with role & id
			$sessionData = array(
					'id' => $roleData->id,
					'role' => $roleData->role
			);
			
			$this->session->set_userdata($sessionData);
		} else {
			$this->session->set_flashdata(
					'login_error',
					$this->lang->line('login_failed')
			);
			redirect(site_url());
		}
	}

	function _checkDuplication($id, $email, $role, $redirect): void
	{
		// Check duplicate id
		$num_duplicate = $this->db->select()->from($role)
			->where('id', $id)->get()->num_rows();
		if (!empty($num_duplicate)) {
			$this->session->set_flashdata('register_error',
				$this->lang->line('register_duplicate_id'));
			redirect($redirect);
		}

		$email_duplicate = $this->db->select()->from('Account')
			->where('email', $email)->get()->num_rows();
		if (!empty($email_duplicate)) {
			$this->session->set_flashdata('register_error',
				$this->lang->line('register_duplicate_email'));
			redirect($redirect);
		}
	}
	
	/**
	 * For registration user with input data.
	 *
	 * @return void
	 */
	public function register(): void
	{
		// Retrieving data from user input post
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$id = $this->input->post('id');
		$name = $this->input->post("name");
		$phone = $this->input->post("phone");
		$token = $this->account_verify->create_random(Verification::REGISTER);

		$this->_checkDuplication($id, $email, AccountRole::PEMINJAM, 'register');
		
		// Get encrypted password hash, then insert data email, password_hash,
		// and generated token to table Account
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		$encrypted_hash = $this->encryption->encrypt($password_hash);
		$data = array(
				"email" => $email,
				"password" => $encrypted_hash,
				"token" => $token,
				"role" => AccountRole::PEMINJAM
		);
		$this->db->insert('Account', $data);
		
		// Get account_id FROM table account
		$fkid = $this->db->select()->from('Account')
				->where('email', $email)->get()
				->first_row()->account_id;
		
		// Insert data id, name, phone, & (id FROM Account) to table peminjam
		$data = array(
				"id" => $id,
				"name" => $name,
				"phone" => $phone,
				"role" => PeminjamRole::MAHASISWA,
				"account_id" => $fkid
		);
		$this->db->insert('Peminjam', $data);
		
		$this->account_verify->send_email($email, $token);
		$this->session->set_flashdata('email_verify',
				$this->lang->line('register_success'));
		
		redirect(site_url());
	}

	public function send_feedback($message)
	{
		$this->account_verify->send_feedback($message);
	}
	
	/**
	 * Determines email to use for the OTP code
	 * Creates session based on the email and the otp code
	 *
	 * @return void
	 */
	public function create_verification(): void
	{
		// Retrieving data from user input post
		$email = $this->input->post('email');
		$otp = $this->account_verify->create_random(Verification::OTP);
		
		// Make sure the email has been verified before perform change password
		$query = $this->db->select()->from('Account')
				->where('email', $email)->where('is_verif', 1)
				->get();
		
		// Account not yet verified
		if (empty($query->num_rows())) {
			$this->session->set_flashdata('login_error',
					$this->lang->line('forgot_pass_failed'));
			redirect('login/forgot');
		}
		
		$this->account_verify->send_email($email, $otp, true);
		$array = array(
				'email' => $email,
				'token' => $otp,
				'has_verification' => true
		);
		
		$this->session->set_tempdata($array, null, 3600);
	}
	
	/**
	 * For resetting password
	 */
	public function newpass($password): void
	{
		// gets the session based on the email input
		$email = $this->session->userdata('email');
		
		// Fetching from database
		$query = $this->db->select()->from('Account')
				->where('email', $email)->get();
		
		// Get encrypted password hash, then insert password_hash to table Account
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		$encrypted_hash = $this->encryption->encrypt($password_hash);
		
		/**
		 * Checking whether the data exist  or not.
		 * If exist        = Updates the password field -> redirect to first view -> destroy session
		 * If not        = failed -> go back to reset password page
		 */
		if ($query->num_rows() > 0) {
			$this->db->set('password', $encrypted_hash)->where('email', $email)
					->update('Account');
			
			$this->session->sess_destroy();
			
			redirect('login');
		} else {
			echo "failed";
			redirect('login/forgot');
		}
		
	}
	
	/**
	 * Get current user data's of session
	 *
	 * @return object
	 */
	public function get_current_account_data(): object
	{
		$currentSession = $this->session->get_userdata();
		
		return $this->db->select()->from($currentSession['role'])->join(
				'Account',
				"Account.account_id = " . $currentSession['role'] . ".account_id",
				'inner'
		)->where('id', $currentSession['id'])->get()->first_row();
	}
	
	/**
	 * Update current user data's of session
	 * - name
	 * - phone
	 *
	 * @param array $data
	 * @return void
	 */
	public function edit(array $data): void
	{
		// TODO need refactor this logic
		$currentSessionData = $this->session->get_userdata();
		
		switch ($currentSessionData['role']) {
			case AccountRole::PENGELOLA:
				$this->db->set('name', $data['account_name'])
						->where('id', $currentSessionData['id'])
						->update($currentSessionData['role']);
				break;
				
			case AccountRole::PIMPINAN:
			case AccountRole::PEMINJAM:
				$this->db->set('name', $data['account_name'])
					->set('phone', $data['account_phone'])
					->where('id', $currentSessionData['id'])
					->update($currentSessionData['role']);
				break;
		}
	}
	
	function verify_email(string $token): void
	{
		$this->db->set('is_verif', 1)->where('token', $token)
				->update('Account');
	}
	
	public function logout(): void
	{
		$this->session->sess_destroy();
	}
}

