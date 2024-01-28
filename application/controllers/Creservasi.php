<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Mpdf $pdf
 * @property Mnotification $notification
 * @property Mrooms $ruangan
 * @property Mpemimpin $pemimpin
 * @property Mreservasi $reservasi
 * @property CI_Upload $uploadttd
 * @property CI_Upload $uploadlogokiri
 * @property CI_Upload $uploadlogokanan
 * @property CI_Session $session
 * @property CI_Input $input
 */
class Creservasi extends Broom_Controller
{
	private array $current_session;

	public function __construct()
	{
		parent::__construct();
		$this->_check_is_logged_in();
		$this->load->model('Mpdf', 'pdf');
		$this->load->model('Mnotification', 'notification');
		$this->load->model('Mreservasi', 'reservasi');
    	$this->load->model('Mpemimpin', 'pemimpin');
		$this->load->model('Mrooms', 'ruangan');
		$this->current_session = $this->session->get_userdata();
	}

	/**
	 * Reservation data for pengelola
	 *
	 * @return void
	 */
	function index(): void
	{
		$role = $this->current_session['role'];
		$data = array();
		$view = array();

		// Determine which page should be loaded.
		switch ($role) {
			case AccountRole::PEMINJAM:
				$view['content'] 			= 'menu_peminjam/reservasi';
				$data['pilihan_ruangan']	= $this->input->post('pilihan-ruangan');
				$view['sidebar'] 			= 'layouts/sidebar';
				break;

			case AccountRole::PIMPINAN:
				// add variable and get DATABASE reservasi
				$data['hasil']	 = $this->pemimpin->pesetujuan();
				$view['content'] = 'menu_pimpinan/persetujuan';
				$view['sidebar'] = 'layouts/sidebar_pimpinan';
				break;

			case AccountRole::PENGELOLA:
				$data['reservation']	= $this->reservasi->getAllReservation();
				$view['content'] 		= 'menu_pengelola/reservation';
				$view['sidebar'] 		= 'layouts/sidebar_pengelola';
				break;
		}

		$html['current_uri'] = "reservasi";
		$html['content'] = $this->load->view($view['content'], $data, true);
		$this->load->view($view['sidebar'], $html);
	}

	/**
	 * Used to check availability of a room while user filling the reservation form.
	 *
	 * @return void
	 */
	function check_ruangan_availability()
	{
		$data = array(
			'ruangan' 	=> $this->input->post('ruangan'),
		);

		$jumlah = $this->ruangan->check_ruangan_availability($data);
		echo json_encode($jumlah);
	}

	/**
	 * Check collision between reservation
	 *
	 * @return void
	 */
	function check_reservation_collide()
	{
		$data = array(
			'ruangan' 	=> $this->input->post('ruangan'),
			'dateStart'	=> $this->input->post('dateStart'),
			'dateEnd'	=> $this->input->post('dateEnd'),
			'timeStart'	=> $this->input->post('timeStart'),
			'timeEnd'	=> $this->input->post('timeEnd')
		);

		$response['isNull'] = false;

		foreach ($data as $datum) {
			if (empty($datum)) {
				$response['isNull'] = true;
				break;
			}
		}

		$response['isAvailable'] = $this->reservasi->check_reservation_collide($data);
		echo json_encode($response);
	}

	function uploadpdf(): void
	{
		$data = $this->pdf->retrieveData();

		$image = $this->_imageUploadHandler();
		$data['head_committee_sign'] 	= $image['ttd-ketua-panitia'];
		$data['left_logo']				= $image['left-logo'];
		$data['right_logo']				= $image['right-logo'];

		// Perform the upload in models
		$uploaded = $this->pdf->pdfUpload($data);

		if (!empty($uploaded->reservasi_id)) {
			// Set peminjam notification
			$this->notification->setNotification(
				NotificationType::PEMINJAM_MENGAJUKAN,
					$uploaded->reservasi_id
			);

			// Set Pimpinan Notification
			$this->notification->setNotification(
					NotificationType::PIMPINAN_DIAJUKAN,
					$uploaded->reservasi_id
			);
		}
		
		$this->session->set_flashdata('message', $uploaded->message);
		redirect(site_url('reservation'));
	}

	function previewpdf(): void
	{
		$data = $this->pdf->retrieveData();

		$image = $this->_imageUploadHandler();
		$data['head_committee_sign'] 	= $image['ttd-ketua-panitia'];
		$data['left_logo']				= $image['left-logo'];
		$data['right_logo']				= $image['right-logo'];

		$this->pdf->pdfPreview($data);
		
		if (!empty($image['ttd-ketua-panitia'])) {
			$this->_imageDeletion($data['ttd-ketua-panitia'], FCPATH .'assets/images/signature_peminjam/');
		}
		
		if (!empty($image['left-logo'])) {
			$this->_imageDeletion($data['left-logo'], FCPATH.'assets/images/left_logo/');
		}
		
		if (!empty($image['right-logo'])) {
			$this->_imageDeletion($data['right-logo'], FCPATH.'assets/images/right_logo/');
		}
	}
	
	function document($id): void
	{
		$data = $this->pemimpin->getDocument($id);
		$this->pdf->pdfPreview($data);
	}

	function detail($reservasi_id): void
	{
		// add variable and get DATABASE reservasi
		$data['hasil'] = $this->pemimpin->lengkap($reservasi_id);
		$data['content']=$this->load->view('menu_pimpinan/persetujuan_detail',$data,TRUE);
		$data['current_uri'] = 'reservasi';
		$this->load->view('layouts/sidebar_pimpinan',$data);
	}

	function cancel(): void
	{
		$id 		= $this->input->post('reservasi_id');
		$message	= $this->input->post('message');

		$this->reservasi->cancel($id, $message);
		$this->notification->setNotification(
				NotificationType::PENGELOLA_MEMBATALKAN,
				$id);
		$this->notification->setNotification(
				NotificationType::PEMINJAM_DIBATALKAN,
				$id);

		redirect('reservation');
	}

	function decision($reservasi_id, $status): void
	{
		// Set notification to peminjam
		if ($status == 'accpet') {
			$type = NotificationType::PEMINJAM_DISETUJUI;
		} else {
			$type = NotificationType::PEMINJAM_DITOLAK;
		}

		// Set reservation status
		if ($status == 'accpet') {
			$reservationStatus = StatusReservasi::DITERIMA;
		} else {
			$reservationStatus = StatusReservasi::DITOLAK;
		}

		$this->pemimpin->keputusan($reservasi_id, $reservationStatus);

		// Notify pengelola when a reservation is approved
		if ($type == NotificationType::PEMINJAM_DISETUJUI) {
			$this->notification->setNotification(
					NotificationType::PENGELOLA_DINOTIFIKASI, $reservasi_id);
		}

		// Notify peminjam
		$this->notification->setNotification($type, $reservasi_id);

		redirect(base_url('reservation'));
	}

	function _imageUploadHandler(): array
	{
		// Upload peminjam signature
		$config1 = array(
			'upload_path' 	=> FCPATH.'assets/images/signature_peminjam/',
			'allowed_types' => 'jpg|png',
			'max_size' 		=> 0,
			'max_width'		=> 0,
			'max_height'	=> 0
		);

		$this->load->library('upload', $config1, 'uploadttd');
		$this->uploadttd->initialize($config1);

		if ( ! $this->uploadttd->do_upload('ttd-ketua-panitia')) {
			// TODO: please do a improvement to display the error
			$message['error'] 	= $this->uploadttd->display_errors();
			$html['reservasi']		= $this->load->view('menu_peminjam/reservasi', $message, true);
			$this->load->view('layouts/sidebar', $html);
		} else {
			$upload1 = $this->uploadttd->data();
			$image['ttd-ketua-panitia'] = $upload1['file_name'];
		}
		// End Upload

		// Upload left logo
		$config2 = array(
			'upload_path' 	=> FCPATH.'assets/images/left_logo/',
			'allowed_types' => 'jpg|png',
			'max_size' 		=> 0,
			'max_width'		=> 0,
			'max_height'	=> 0
		);

		$this->load->library('upload', $config2, 'uploadlogokiri');
		$this->uploadlogokiri->initialize($config2);

		if ( ! $this->uploadlogokiri->do_upload('logo-kiri')) {
			$image['left-logo'] = null;
		} else {
			$upload2 = $this->uploadlogokiri->data();
			$image['left-logo'] = $upload2['file_name'];
		}
		// End Upload

		// Upload right logo
		$config3 = array(
			'upload_path' 	=> FCPATH.'assets/images/right_logo/',
			'allowed_types' => 'jpg|png',
			'max_size' 		=> 0,
			'max_width'		=> 0,
			'max_height'	=> 0
		);

		$this->load->library('upload', $config3, 'uploadlogokanan');
		$this->uploadlogokanan->initialize($config3);

		if ( ! $this->uploadlogokanan->do_upload('logo-kanan')) {
			$image['right-logo'] = null;
		} else {
			$upload3 = $this->uploadlogokanan->data();
			$image['right-logo'] = $upload3['file_name'];
		}
		// End Upload

		return $image;
	}

	function _imageDeletion($image_name, $image_path): void
	{
		$full_path = $image_path . $image_name;

		unlink($full_path);
	}
}
