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
	
	function getNotification(): object|array
	{
		$id = $this->session->userdata('id');
		$role = $this->session->userdata('role');
		
		return match ($role) {
			AccountRole::PENGELOLA => $this->_getPengelolaNotification(),
			default => $this->_getDefaultNotification($role, $id)
		};
	}
	
	function _getPengelolaNotification(): object|array
	{
		return $this->db->select(
		'*, Notification.type as type,
				Reservasi.document_number as number,
				Ruangan.name as ruangan,
				Peminjam.name as peminjam,
				Pimpinan.name as pimpinan')
		->from('Notification')
		->where('type = 301')->or_where('type = 302')
		->join('Reservasi', 'Reservasi.reservasi_id = Notification.reservasi_id')
		->join('Ruangan', 'Ruangan.id = Reservasi.ruangan_id')
		->join('Peminjam', 'Peminjam.id = Reservasi.peminjam_id')
		->join('Pimpinan', 'Pimpinan.id = Reservasi.pimpinan_id')
		->order_by('Notification.date_inserted', 'DESC')
		->get()->result();
	}
	
	function _getDefaultNotification($role, $id): object|array
	{
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
				->join('Ruangan',
						'Ruangan.id = Reservasi.ruangan_id')
				->join('Pimpinan',
						'Pimpinan.id = Reservasi.pimpinan_id')
				->join('Peminjam',
						'Peminjam.id = Reservasi.peminjam_id')
				->where(strtolower($role).'_id', $id)
				->order_by('Notification.date_inserted', 'DESC')
				->get()->result();
	}
}
