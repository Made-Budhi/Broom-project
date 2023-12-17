<?php
/**
 * @property CI_DB $db
 */
class Mrooms extends CI_Model {

    function tampildata($id)
    {
        $start=$this->input->post('tgl');
        $sql="SELECT * FROM Reservasi WHERE ('$start' BETWEEN date_start AND date_end) AND ruangan_id = '$id';";
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
        $sql="SELECT * FROM Ruangan";
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
