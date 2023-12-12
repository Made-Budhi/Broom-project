<?php


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
	function pdfPreview(array $data)
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
	 *
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
			'pilihan-logo-pnb'		=> $this->input->post('pilihan-logo-pnb'),
			'pilihan-organisasi'	=> $this->input->post('pilihan-organisasi'),
			'nama-organisasi'		=> $this->input->post('nama-organisasi'),

			// Body Data
			'tanggal-pengajuan' 	=> date('Y-m-d', now()),
			'nomor-dokumen' 		=> $this->input->post('nomor-dokumen'),
			'lampiran'				=> $this->input->post('lampiran'),
			'perihal'				=> $this->input->post('perihal'),
			'kegiatan'				=> $this->input->post('kegiatan'),
			'penyelenggara'			=> $this->input->post('penyelenggara'),
			'tanggal-mulai'			=> $this->input->post('tanggal-mulai'),
			'jam-mulai'				=> $this->input->post('jam-mulai'),
			'tanggal-selesai'		=> $this->input->post('tanggal-selesai'),
			'jam-selesai'			=> $this->input->post('jam-selesai'),
			'id-pimpinan'			=> $pimpinan->id,
			'nama-pimpinan'			=> $pimpinan->name,
			'jabatan-pimpinan'		=> $pimpinan->position,
			'id-ruangan'			=> $ruangan->id,
			'nama-ruangan'			=> $ruangan->name,
			'nama-ketua-panitia'	=> $this->input->post('nama-ketua-panitia'),
			'id-ketua-panitia'		=> $this->input->post('id-ketua-panitia'),
			'status'				=> 'Menunggu',

			// Footer Data
			'tembusan' 				=> $this->input->post('tembusan')
		);
	}
}
