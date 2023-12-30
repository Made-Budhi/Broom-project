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
	
	function setPeminjamNotification(int $type, int $reservasi_id): void
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

	function setPimpinanNotification(int $type, int $reservasi_id): void
	{
		$data = array(
			'id'			=> '',
			'type'			=> $type,
			'reservasi_id'	=> $reservasi_id
		);

		$this->db->insert('Notification', $data);
	}

	function getPemimpinNotification(): array
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
}
