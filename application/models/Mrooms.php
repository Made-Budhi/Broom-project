<?php 

class Mrooms extends CI_Model {

    function tampildata($gedung)
    {
        $start=$this->input->post('tgl');
        $sql="SELECT * FROM schedule_list WHERE ('$start' BETWEEN start_datetime AND end_datetime) AND gedung='$gedung  ';";
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

    function tampilgedung()
    {
        
        $sql="select * from list_gedung";
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

    function gedung(){
        $sql="select * from schedule_list WHERE gedung";
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

}

    

?>