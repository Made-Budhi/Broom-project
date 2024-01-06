<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB $db
 * @property CI_Session $session
 */
class Mnotification extends CI_Model
{
	function setNotification(int $type, int $reservasi_id): void
	{
		$data = array(
				'id'			=> '',
				'type'			=> $type,
				'reservasi_id'	=> $reservasi_id
		);
		
		$this->db->insert('Notification', $data);
	}
	
	function getNotification(): array
	{
		$id = $this->session->userdata('id');
		$role = strtolower( $this->session->userdata('role'));
		$result = $this->db->select(
				'Notification.type,
				reservation_date,
				reservation_date,
				date_start,
				date_end,
				Ruangan.name,
				position'
		)->from('Notification')
				->join('Reservasi',
						'Reservasi.reservasi_id = Notification.reservasi_id')
				->join('Ruangan',
						'Ruangan.id = Reservasi.ruangan_id')
				->join('Pimpinan',
						'Pimpinan.id = Reservasi.pimpinan_id')
				->where($role.'_id', $id)
				->get()->result();
		
		return $result;
	}

	function getPeminjamNotification(): object|array
	{
		$currentSession = $this->session->get_userdata();
		$id = $currentSession['id'];

		return $this->db->select(
		'Notification.type, 
				reservation_date,
				date_start, 
				date_end, 
				Ruangan.name,
				position')
				->from('Notification')
				->join('Reservasi',
						'Reservasi.reservasi_id = Notification.reservasi_id')
				->join('Ruangan', 'Ruangan.id = Reservasi.ruangan_id')
				->join('Pimpinan', 'Pimpinan.id = Reservasi.pimpinan_id')
				->where('peminjam_id', $id)
				->get()->result();
	}

	function getPemimpinNotification(): object|array
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
		->where('pimpinan_id', $id)
		->join('Ruangan', 'Ruangan.id = Reservasi.ruangan_id')
		->join('Pimpinan', 'Pimpinan.id = Reservasi.pimpinan_id')
		->get()->result();
	}

	function getPengelolaNotification(): object|array
	{
		return $this->db->select(
		'*, Notification.type as type,
				Reservasi.document_number as number,
				Ruangan.name as ruangan,
				Peminjam.name as peminjam,
				Pimpinan.name as pimpinan')
		->from('Notification')
		->where('type = 301 OR type = 302')
		->join('Reservasi', 'Reservasi.reservasi_id = Notification.reservasi_id')
		->join('Ruangan', 'Ruangan.id = Reservasi.ruangan_id')
		->join('Peminjam', 'Peminjam.id = Reservasi.peminjam_id')
		->join('Pimpinan', 'Pimpinan.id = Reservasi.pimpinan_id')
		->get()->result();
	}
}
