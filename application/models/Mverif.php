<?php 
class Mverif extends CI_Model {

	private array $configuration;

	/**
	 * Load the smtp configuration
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->config('BRoom/EmailVerify');
		$this->configuration = $this->config->config;
	}

	/**
     *  Create random numbers by shuffling $nomor variable
     */
    public function buatotp(): string
	{
            $nomor="1234567890";
			$otp=substr(str_shuffle($nomor),0,6);

			return $otp;
    }

    /**
     * Determines email to use for the otp code
     * Creates session based on the email and the otp code
	 *
	 * @return void
     */
    public function simpanverif()
	{
        // Retrieving data from user input post
        $Email=$this->input->post('email');
        $token=$this->buatotp();

        // Fetching from database
        $sql="select * from Account where email='".$Email."' "; // TODO: Check the is_verif value. Make sure the email has been verified before the user could perform change password
		$query=$this->db->query($sql);

        /*
		 * Checking whether the data exists or not.
		 * If exist		= Query for row -> Creates $array contains email and otp code -> Creates Session based on
         * 				  $array -> calls sendmail($token, $Email) function
		 * If not		= Failed to send
		 */
        if($query->num_rows()>0) {
            $data=$query->row();

            $array=array(
				'email'=>$Email,
				'token'=>$token
            );

			$this->session->set_userdata($array);
			$this->sendmail($token,$Email);
        }
        else {
            echo "failed";
        }
    }

    /**
     * For creating an smtp to mail the otp code
     */
    public function sendmail($token,$Email){
		// Send email
        $this->email->initialize($this->configuration);
        $this->email->from('no-reply@anoninin.com','BRoom Admin');
        $this->email->to($Email);
        $this->email->subject("Verifikasi email");
        $this->email->message("OTP anda ".$token."");
        
        /*
		 * Checking whether to send the email or not.
		 * If exist		= go to insert otp page
		 * If not		= Failed to send
		 */
        if ($this->email->send()){
            redirect('chalaman/otp');
        }
        else{
         echo"failed";
        }
     }

     /**
      * For resetting password
      */
     function newpass($password){
        // gets the session based on the email input
        $Email=$this->session->userdata('email');

        // Fetching from database
        $sql="select * from Account where email='".$Email."' ";
		$query=$this->db->query($sql);

         /*
		 * Checking whether the data exist  or not.
		 * If exist		= Updates the password field -> redirect to first view -> destroy session
-		 * If not		= failed -> go back to reset password page
		 */
        if($query->num_rows()>0)
		{
            $sql="UPDATE Account set password='".$password."' where email ='".$Email."' ";
            $this->db->query($sql);
            redirect('cviews/loginpage');
            $this->session->sess_destroy();
        }
        else{
            echo "failed";
            redirect('chalaman/reset');
        }
        
     }
}
?>
