<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Mpdf $pdf
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
	}

	function reservasi($message = ''): void
	{
		$data['message'] = $message;
		$html['reservasi'] = $this->load->view('menu_peminjam/reservasi', $data, true);
		$this->load->view('layouts/sidebar', $html);
	}

	function uploadpdf(): void
	{
		$data = $this->pdf->retrieveData();

		$image = $this->imageUploadHandler();
		$data['ttd-ketua-panitia'] 	= $image['ttd-ketua-panitia'];
		$data['left-logo']			= $image['left-logo'];
		$data['right-logo']			= $image['right-logo'];

		// Perform the upload in models
		$message = $this->pdf->pdfUpload($data);

		$this->reservasi($message);
	}

	function previewpdf(): void
	{
		$data = $this->pdf->retrieveData();

		$image = $this->imageUploadHandler();
		$data['ttd-ketua-panitia'] 	= $image['ttd-ketua-panitia'];
		$data['left-logo']			= $image['left-logo'];
		$data['right-logo']			= $image['right-logo'];

		$this->pdf->pdfPreview($data);

		$this->imageDeletion($data['ttd-ketua-panitia'], 'C:/xampp/htdocs/Broom-project/public_html/assets/images/signature_peminjam/');
		$this->imageDeletion($data['left-logo'], 'C:/xampp/htdocs/Broom-project/public_html/assets/images/left_logo/');
		$this->imageDeletion($data['right-logo'], 'C:/xampp/htdocs/Broom-project/public_html/assets/images/right_logo/');
	}

	function imageUploadHandler(): array
	{
		// Upload peminjam signature
		$config1 = array(
			'upload_path' 	=> 'C:/xampp/htdocs/Broom-project/public_html/assets/images/signature_peminjam/',
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
			'upload_path' 	=> 'C:/xampp/htdocs/Broom-project/public_html/assets/images/left_logo/',
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
			'upload_path' 	=> 'C:/xampp/htdocs/Broom-project/public_html/assets/images/right_logo/',
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
