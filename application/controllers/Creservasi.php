<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Mpdf $pdf
 * @property Mnotification $notification
 * @property CI_Upload $uploadttd
 * @property CI_Upload $uploadlogokiri
 * @property CI_Upload $uploadlogokanan
 */
class Creservasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mpdf', 'pdf');
		$this->load->model('Mnotification', 'notification');
	}

	function reservasi($message = ''): void
	{
		$data['message'] = $message;
		$html['content'] = $this->load->view('menu_peminjam/reservasi', $data, true);
		$this->load->view('layouts/sidebar', $html);
	}

	function uploadpdf(): void
	{
		$data = $this->pdf->retrieveData();

		$image = $this->imageUploadHandler();
		$data['head_committee_sign'] 	= $image['ttd-ketua-panitia'];
		$data['left_logo']				= $image['left-logo'];
		$data['right_logo']				= $image['right-logo'];

		// Perform the upload in models
		$upload = $this->pdf->pdfUpload($data);

		if (!empty($upload['reservasi_id'])) {
			// Set peminjam notification
			$this->notification->setPeminjamNotification(
				'101',
				$upload['reservasi_id']->reservasi_id
			);

			// Set Pimpinan Notification
			$this->notification->setPimpinanNotification(
				'201',
				$upload['reservasi_id']->reservasi_id
			);
		}

		$this->reservasi($upload['message']);
	}

	function previewpdf(): void
	{
		$data = $this->pdf->retrieveData();

		$image = $this->imageUploadHandler();
		$data['head_committee_sign'] 	= $image['ttd-ketua-panitia'];
		$data['left_logo']				= $image['left-logo'];
		$data['right_logo']				= $image['right-logo'];

		$this->pdf->pdfPreview($data);
		
		if (!empty($image['ttd-ketua-panitia'])) {
			$this->imageDeletion($data['ttd-ketua-panitia'], FCPATH .'assets/images/signature_peminjam/');
		}
		
		if (!empty($image['left-logo'])) {
			$this->imageDeletion($data['left-logo'], FCPATH.'assets/images/left_logo/');
		}
		
		if (!empty($image['right-logo'])) {
			$this->imageDeletion($data['right-logo'], FCPATH.'assets/images/right_logo/');
		}
	}

	function imageUploadHandler(): array
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

	function imageDeletion($image_name, $image_path): void
	{
		$full_path = $image_path . $image_name;

		unlink($full_path);
	}
}
