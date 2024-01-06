<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_DB $db
 */
class Mreservasi extends CI_Model
{
	private array $current_session;
	
	public function __construct()
	{
		parent::__construct();
		$this->current_session = $this->session->get_userdata();
	}
	
	function tampildata($key): array
	{
		$hasil = array();
		$query = $this->db->select('*,
				Reservasi.status as reservasi_status')->from("Reservasi")
				->join(
				"Ruangan",
				"Reservasi.ruangan_id = Ruangan.id",
				"inner")
				->where($key, $this->current_session['id'])->get();
		
		// to check query database
		foreach ($query->result() as $row) {
			$hasil[] = $row;
		}
		
		// return variable to get database
		return $hasil;
	}
	
	function get_data_assigned(): ?array
	{
		
		$datas = $this->db->select('*,
				Reservasi.status as reservasi_status,
				Peminjam.name as peminjam_name')->from("Reservasi")
				->join(
						"Peminjam",
						"Reservasi.peminjam_id = Peminjam.id",
						"inner")
				->join(
						"Ruangan",
						"Reservasi.ruangan_id = Ruangan.id",
						"inner")
				->where('pimpinan_id', $this->current_session['id'])->get();
		$result = null;

		foreach ($datas->result() as $data) {
			if ($data->reservasi_status == StatusReservasi::DITERIMA ||
				$data->reservasi_status == StatusReservasi::DITOLAK) {
				$result[] = $data;
			}
		}
		
		return $result;
	}

	/**
	 * Get all reservation for pengelola's reservation menu
	 *
	 * @return array|object
	 */
	function getAllReservation(): array|object
	{
		return $this->db->select('*, 
		Reservasi.status as reservasi_status,
		Peminjam.name as peminjam,
		Pimpinan.name as pimpinan,
		Ruangan.name as ruangan')
			->from('Reservasi')
			->join('Peminjam', 'Peminjam.id = peminjam_id')
			->join('Pimpinan', 'Pimpinan.id = pimpinan_id')
			->join('Ruangan', 'Ruangan.id = ruangan_id')
			->get()->result();
	}

	function cancel($id, $message): void
	{
		$this->db
			->set('status', statusReservasi::DIBATALKAN)
			->set('status_message', $message)
			->where('reservasi_id', $id)
			->update('Reservasi');
	}
}
