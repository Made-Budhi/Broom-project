<?php

    class Mreservasi extends CI_Model 
    {
        function tampildata()
		{
			$sessions = $this->session->get_userdata();
			
			$query= $this->db->select()->from("reservasi")->join(
				"peminjam",
				"reservasi.peminjam_id = peminjam.id",
				"inner"
				)->where("peminjam_id",$sessions['id'])->get();
			
            // to check query database
			if ($query->num_rows()>0)
			{
                // put the quest to variable
				foreach ($query->result() as $row)
				{
					$hasil[]=$row;
				}	
			}
			else
			{
				$hasil="";	
			}
            // return variable to get database
			return $hasil;	
		}



    }

?>