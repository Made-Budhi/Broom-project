<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mnotification extends CI_Model
{
	function setPeminjamNotification(int $type, int $reservasi_id)
	{
		$data = array(
			'id'			=> '',
			'type'			=> $type,
			'reservasi_id'	=> $reservasi_id
		);

		$this->db->insert('Notification', $data);
	}

	function getPeminjamNotification(): array
	{
		$session = $this->session->get_userdata();
		$id = $session['id'];

		return $this->db->select(
		'Notification.type, 
				reservation_date,
				date_start, 
				date_end, 
				Ruangan.name,
				position')
		->from('Notification')
		->join('Reservasi', 'Reservasi.reservasi_id = Notification.reservasi_id')
		->where('peminjam_id', $id)
		->join('Ruangan', 'Ruangan.id = Reservasi.ruangan_id')
		->join('Pimpinan', 'Pimpinan.id = Reservasi.pimpinan_id')
		->get()->result();
	}
}
