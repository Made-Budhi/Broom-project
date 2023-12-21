<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Loader $load
 * @property CI_Lang $lang
 * @property CI_DB $db
 * @property CI_Input $input
 * @property CI_Session $session
 */
class Mpdf extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->language('BRoomDatabase_lang', 'english');
	}

	/**
	 *
	 *
	 * @param array $data
	 * @return void
	 */
	function pdfPreview(array $data): void
    {
		$this->load->helper('pdf');

		$reservationdata['data'] = $data;

		$html = $this->load->view('layouts/layoutpdf', $reservationdata, true);

		createpdf($html);
	}

	/**
	 * Upload the reservation data to database.
	 *
	 * @param array $data
	 * @return string
	 */
	function pdfUpload(array $data): string
	{
		// Get peminjam id
		$peminjam_id = $this->session->get_userdata();

		$newData = array(
			'reservasi_id'			=> '',
			'peminjam_id'			=> $peminjam_id['id'],
			'ruangan_id'			=> $data['id-ruangan'],
			'pimpinan_id'			=> $data['id-pimpinan'],
			
			'organization_choice'	=> $data['pilihan-organisasi'],
			'organization_name'		=> $data['nama-organisasi'],
			'head_committee_name'	=> $data['nama-ketua-panitia'],
			'head_committee_id' 	=> $data['id-ketua-panitia'],
			'head_committee_sign'	=> $data['ttd-ketua-panitia'],
			
			'date_start'			=> $data['tanggal-mulai'],
			'time_start'			=> $data['jam-mulai'],
			'date_end'				=> $data['tanggal-selesai'],
			'time_end'				=> $data['jam-selesai'],

			'document_number'		=> $data['nomor-dokumen'],
			'reservation_date'		=> $data['tanggal-pengajuan'],
			'purpose'				=> $data['perihal'],
			'attachment'			=> $data['lampiran'],
			'event'					=> $data['kegiatan'],
			'organizer'				=> $data['penyelenggara'],
			'copy'					=> $data['tembusan'],
			'pnb_logo_choice'		=> $data['pilihan-logo-pnb'],
			'left_logo'				=> $data['left-logo'],
			'right_logo'			=> $data['right-logo'],
			'status'				=> $data['status']
		);

		$is_success = $this->db->insert('Reservasi', $newData);

		if ($is_success) {
			return $this->lang->line('database_insertion_success');
		}

		return $this->lang->line('database_insertion_failed');
	}

	/**
	 * Retrieve data from reservation form
	 *
	 * @return array
	 */
	function retrieveData(): array
	{
		$idpimpinan	= $this->input->post('pimpinan');
		$pimpinan 	= $this->db->select()->from('Pimpinan')->where('id', $idpimpinan)->get()->row();

		$idruangan	= $this->input->post('ruangan');
		$ruangan 	= $this->db->select()->from('Ruangan')->where('id', $idruangan)->get()->row();

		return array(
			// Header Data
			'pnb_logo_choice'		=> $this->input->post('pilihan-logo-pnb'),
			'organization_choice'	=> $this->input->post('pilihan-organisasi'),
			'organization_name'		=> $this->input->post('nama-organisasi'),

			// Body Data
			'reservation_date' 		=> date('Y-m-d', now()),
			'document_number' 		=> $this->input->post('nomor-dokumen'),
			'attachment'			=> $this->input->post('lampiran'),
			'purpose'				=> $this->input->post('perihal'),
			'event'					=> $this->input->post('kegiatan'),
			'organizer'				=> $this->input->post('penyelenggara'),
			'date_start'			=> $this->input->post('tanggal-mulai'),
			'time_start'			=> $this->input->post('jam-mulai'),
			'date_end'				=> $this->input->post('tanggal-selesai'),
			'time_end'				=> $this->input->post('jam-selesai'),
			'pimpinan_id'			=> $pimpinan->id,
			'pimpinan_name'			=> $pimpinan->name,
			'pimpinan_position'		=> $pimpinan->position,
			'ruangan_id'			=> $ruangan->id,
			'ruangan_name'			=> $ruangan->name,
			'head_committee_name'	=> $this->input->post('nama-ketua-panitia'),
			'head_committee_id'		=> $this->input->post('id-ketua-panitia'),
			'status'				=> 'Menunggu',

			// Footer Data
			'copy'	 				=> $this->input->post('tembusan')
		);
	}
}
