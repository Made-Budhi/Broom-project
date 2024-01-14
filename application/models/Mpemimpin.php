<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_DB $db
 */

 class Mpemimpin extends CI_Model
 {

    function pesetujuan(): array
	{
		$session = $this->session->get_userdata();
		$id = $session['id'];

		$hasil = array();

        $query = $this->db->select()->from('Reservasi')
        ->join(
          "Ruangan",
				  "Reservasi.ruangan_id = Ruangan.id",
				  "inner"
        )->where("Reservasi.status = '" . StatusReservasi::MENUNGGU . "' AND pimpinan_id = " . $id)->get();

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
      ->set('date_assigned',date('Y-m-d', now()))
      ->where('Reservasi.reservasi_id', $reservasi_id)
      ->update('Reservasi');
      
  }

  function getDocument($reservasi_id): array
  {
  	// Reservation Data
    $data = $this->db->select()->from('Reservasi')
		->where('Reservasi.reservasi_id', $reservasi_id)
		->get()->first_row('array');

	// Pimpinan Data
  	$pimpinan = $this->db->select('name,position,signature')->from('Pimpinan')
		->where('Pimpinan.id', $data['pimpinan_id'])
		->get()->first_row('array');

  	// Ruangan Data
  	$ruangan = $this->db->select('name')->from('Ruangan')
		->where('Ruangan.id', $data['ruangan_id'])
		->get()->first_row('array');

	$data['pimpinan_name'] 		= $pimpinan['name'];
	$data['pimpinan_position'] 	= $pimpinan['position'];
	$data['pimpinan_signature']	= $pimpinan['signature'];
	$data['ruangan_name'] 		= $ruangan['name'];

    return $data;
  }
  
  function get_data_pimpinan($id) 
  {
    return $this->db->select('Account.email, Pimpinan.name, Pimpinan.position, Pimpinan.id, Account.account_id, Account.password')
      ->from('Account')
      ->join('Pimpinan',
              'Pimpinan.account_id = Account.account_id')
      ->where('Account.account_id', $id)->get()->result();
  }

}
 
?>
