<?php 
class Mverif extends CI_Model {

    public function buatotp(){
            $nomor="123456789";
			$otp=substr(str_shuffle($nomor),0,6);
			return $otp;
    }

    // public function simpanverif(){
    //     $token=$this->buatotp();
    //     $Email=$this->input->post('email');
    //     $data=array(
    //         'token'=>$token
    //     );

    //     $this->db->insert('tbdaftar',$data);
    //     $this->sendmail($token,$this->input->post('email'));
    //     echo "<script>alert('Dikirim');</script>";
    // }
    public function simpanverif(){
        $Email=$this->input->post('email');
        $token=$this->buatotp();

        $sql="select * from tbdaftar where email='".$Email."' ";
		$query=$this->db->query($sql);
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
    public function sendmail($token,$Email){
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
 
        if ($this->email->send()){
            redirect('chalaman/otp');
        }
        else{
         echo"failed";
        }
     }

     function newpass($password){
        // $password=$this->input->post('password');
        $Email=$this->session->userdata('email');

        $sql="select * from tbdaftar where email='".$Email."' ";
		$query=$this->db->query($sql);
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