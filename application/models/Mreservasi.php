<?php

    class Mreservasi extends CI_Model 
    {
        function tampildata()
		{
			$sql="SELECT * FROM reservasi";
			$query=$this->db->query($sql);
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