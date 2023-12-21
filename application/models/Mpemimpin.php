<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_DB $db
 */

 class Mpemimpin extends CI_Model
 {

    function pesetujuan(){

		$hasil = array();

        $query = $this->db->select()->from('Reservasi')
        ->join(
          "Ruangan",
				  "Reservasi.ruangan_id = Ruangan.id",
				  "inner"
        )->where('Reservasi.status',"Menunggu")->get();

        // to check query database
		  foreach ($query->result() as $row) 
      {
			  $hasil[] = $row;
      }
        // return variable to get database
		return $hasil;
    }

    function lengkap($reservasi_id){
      
      $query = $this->db->select()->from('Reservasi')
      ->join(
				"Peminjam",
				"Reservasi.peminjam_id = Peminjam.id",
				"inner")
      ->join(
        "Ruangan",
        "Reservasi.ruangan_id = Ruangan.id",
        "inner"
      )->where('Reservasi.reservasi_id',$reservasi_id)->get();

      foreach ($query->result() as $row) 
      {
			  $hasil[] = $row;
      }
        // return variable to get database
		return $hasil;
  }

  function keputusan($reservasi_id, $status) {
    $this->db->set('status', $status)
      ->where('Reservasi.reservasi_id', $reservasi_id)
      ->update('Reservasi');
      
  }

  function getDocument($reservasi_id): array
  {
    $data = $this->db->select()->from('Reservasi')
    ->where('Reservasi.reservasi_id', $reservasi_id)
    ->get()->result('array');

    return $data[0];
    
  }
}
 
 ?>