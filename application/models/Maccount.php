<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property BRoom_Verify $account_verify
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_DB $db
 */
class Maccount extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('accounts/BRoom_Verify', null, 'account_verify');
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
				->where('email', $email)
				->where('password', $password)->get();
		
		/*
		 * Checking whether the data exists or not.
		 * If exist     = identifies role -> join table account with related
		 *                role -> set session
		 * If not       = login authentication failed
		 */
		if ($data->num_rows() > 0) {
			
			$accountData = $data->first_row();
			
			if (!$accountData->is_verif) {
				$this->session->set_flashdata(
						'loginerror',
						'Email belum terverifikasi!.'
				);
				redirect(site_url());
			}
			
			// Join table account with related role
			$roleData = $this->db->select()->from($accountData->role)->join(
					'Account',
					"Account.account_id = " . $accountData->role .
					".account_id",
					'inner'
			)->where('Account.account_id', $accountData->account_id)->get()
					->first_row();
			
			// Setting session with role & id
			$sessionData = array(
					'id' => $roleData->id,
					'role' => $roleData->role
			);
			
			$this->session->set_userdata($sessionData);
		} else {
			$this->session->set_flashdata(
					'loginerror',
					'Invalid e-mail or password.'
			);
			redirect(site_url());
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
		$token = '';
		
		// Insert data email, password, and generated token to table account
		$this->account_verify->send_email($email, $token);
		$data = array(
				"email" => $email,
				"password" => $password,
				"token" => $token,
			// TODO: can set default value from Database
				"role" => "Peminjam"
		);
		unset($token);
		$this->db->insert('Account', $data);
		
		// Build a variable to get account_id FROM table account
		$fkdata = $this->db->select()->from('Account')
				->where('email', $email)->where('password', $password)
				->get()->first_row();
		$fkid = $fkdata->account_id;
		
		// Insert data id, name, phone, & (account_id FROM variable $fkdata) TO table peminjam
		$data = array(
				"id" => $id,
				"name" => $name,
				"phone" => $phone,
			// TODO: can set default value from Database
				"role" => "Mahasiswa",
				"account_id" => $fkid
		);
		$this->db->insert('Peminjam', $data);
		
		echo "<script>alert('Data sudah disimpan, Silahkan Verifikasi');</script>";
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
		$otp = '';
		
		// Make sure the email has been verified before perform change password
		$query = $this->db->select()->from('Account')
				->where('email', $email)->where('is_verif', 1)
				->get();
		
		if ($query->num_rows() > 0) {
			$array = array(
					'email' => $email,
					'token' => $otp
			);
			
			$this->account_verify->send_email($email, $otp, true);
			$this->session->set_userdata($array);
		} else {
			$this->session->set_flashdata(
					'loginerror',
					'Invalid e-mail or password.'
			);
			redirect(site_url('login/forgot/password'));
		}
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
		
		/**
		 * Checking whether the data exist  or not.
		 * If exist        = Updates the password field -> redirect to first view -> destroy session
		 * If not        = failed -> go back to reset password page
		 */
		if ($query->num_rows() > 0) {
			$this->db->set('password', $password)->where('email', $email)
					->update('Account');
			
			$this->session->sess_destroy();
			
			redirect('cviews/loginpage');
		} else {
			echo "failed";
			redirect('chalaman/reset');
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
		$currentSessionData = $this->session->userdata;
		
		$this->db->set('name', $data['account_name'])
				->set('phone', $data['account_phone'])
				->where('id', $currentSessionData['id'])
				->update($currentSessionData['role']);
	}
	
	function verify_email(string $token): void
	{
		$this->db->set('is_verified', true)->where('Token', $token)
				->update('tbdosen');
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
	}
}

