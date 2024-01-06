<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_DB $db
 */

 class Mpengelola extends CI_Model{

    function datasingkat(){
		$hasil = array();

        $query = $this->db->select()->from("Peminjam")
			    ->get();
		
		// to check query database
		foreach ($query->result() as $row) {
			$hasil[] = $row;
        }
        return $hasil;
    }

    function jejakreservasi($id){
		$hasil = array();
        $query = $this->db->select('*, 
		Reservasi.status as reservasi_status'
        )->from('Reservasi')
                ->join(
                    "Ruangan",
                    "Reservasi.ruangan_id = Ruangan.id",
                    "inner"
                )
                ->where('Reservasi.peminjam_id',$id)->get();
  
		foreach ($query->result() as $row) 
		{
			$hasil[] = $row;
		}
        
        // return variable to get database
        return $hasil;
    }



 }


?>