<?php 
class Mverif extends CI_Model {

    /**
     *  Create random numbers by shuffling $nomor variable
     */
    public function buatotp(){
            $nomor="1234567890";
			$otp=substr(str_shuffle($nomor),0,6);
			return $otp;
    }

    /**
     * Determines email to use for the otp code
     * Creates session based on the email and the otp code
     */
    public function simpanverif(){
        // Retrieving data from user input post
        $Email=$this->input->post('email');
        $token=$this->buatotp();

        // Fetching from database
        $sql="select * from tbdaftar where email='".$Email."' ";
		$query=$this->db->query($sql);

        /*
		 * Checking whether the data exists or not.
		 * If exist		= Query for row -> Creates $array contains email and otp code -> Creates Session based on $array -> calls sendmail($token, $Email) function
		 * If not		= Failed to send
		 */
        if($query->num_rows()>0)
		{
            $data=$query->row();
            $array=array(
            'email'=>$Email,
            'token'=>$token
            );	
        $this->session->set_userdata($array);	
        $this->sendmail($token,$Email);
        }
        else{
            echo "failed";
        }
        
    }

    /**
     * For creating an smtp to mail the otp code
     */
    public function sendmail($token,$Email){
        // smtp configuration
        $config['useragent'] = "codeigniter";
        $config['mailpath'] = "usr/bin/sendmail";
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "imadeadianugrah@gmail.com";
        $config['smtp_pass'] = "lshh qmzz ympp vmhe";
        $config['smtp_crypto'] = "ssl";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['smtp_timeout'] = "30";
        $config['wordwrap'] = "TRUE";
 
        $this->email->initialize($config);
        $this->email->from('no-reply@anoninin.com','hihihiha');
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
        $sql="select * from tbdaftar where email='".$Email."' ";
		$query=$this->db->query($sql);

         /*
		 * Checking whether the data exist  or not.
		 * If exist		= Updates the password field -> redirect to first view -> destroy session
-		 * If not		= failed -> go back to reset password page
		 */
        if($query->num_rows()>0)
		{
            $sql="UPDATE tbdaftar set password='".$password."' where email ='".$Email."' ";
            $this->db->query($sql);
            redirect('chalaman/tampil');
            $this->session->sess_destroy();
        }
        else{
            echo "failed";
            redirect('chalaman/reset');
        }
        
     }
}
?>