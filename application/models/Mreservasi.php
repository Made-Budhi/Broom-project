<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_DB $db
 */
class Mreservasi extends CI_Model
{
	function tampildata(): string|array
	{
		$sessions = $this->session->get_userdata();
		$hasil = array();
		
		$query= $this->db->select('*,
				Reservasi.status as reservasi_status')->from("Reservasi")
				->join(
				"Peminjam",
				"Reservasi.peminjam_id = Peminjam.id",
				"inner")
				->join(
				"Ruangan",
				"Reservasi.ruangan_id = Ruangan.id",
				"inner")->where("peminjam_id",$sessions['id'])->get();
		
		// to check query database
		foreach ($query->result() as $row) {
			$hasil[] = $row;
		}
		
		// return variable to get database
		return $hasil;
	}
}
