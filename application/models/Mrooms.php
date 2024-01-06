<?php
/**
 * @property CI_DB $db
 * @property CI_Input $input
 */
class Mrooms extends CI_Model {

    function tampildata($id): array|string
    {
        $hasil = array();
        $start=$this->input->post('tgl');
        $query = $this->db->select()->from('Reservasi')
                ->where_in('date_start', $start)->where_in('date_end', $start)
                ->where('ruangan_id', $id)->get();
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $hasil[]=$row;
            }
        } else {
            $hasil="";	
        }
        
        return $hasil;
    }

    function tampilgedung(): array|string
    {
        $hasil = array();
        $query=$this->db->select()->from('Ruangan')->get();
        
        if ($query->num_rows()>0) {
            foreach ($query->result() as $row) {
                $hasil[]=$row;
            }	
        } else {
            $hasil="";	
        }
        
        return $hasil;
    }

}
