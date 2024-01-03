<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Mpemimpin $pemimpin
 * @property Mpdf $pdf
 * @property Mnotification $notification
 */

class Cpimpinan extends Broom_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mpemimpin', 'pemimpin');
        $this->load->model('Mpdf', 'pdf');
		$this->load->model('Mnotification', 'notification');
    }

    function reservasiV(): void
	{
		// add variable and get DATABASE reservasi
		$reservasiM['hasil'] = $this->pemimpin->pesetujuan();
		// add variable TO Load Dashboard and put DATABASE from resevasi to table
        $data['content']=$this->load->view('menu_pimpinan/persetujuan',$reservasiM,TRUE);
		// view layout with $data
		$this->load->view('layouts/sidebar_pimpinan',$data);
	}

    function detailV($reservasi_id): void
	{
		// add variable and get DATABASE reservasi
		$reservasiM['hasil'] = $this->pemimpin->lengkap($reservasi_id);
		// add variable TO Load Dashboard and put DATABASE from resevasi to table
        $data['content']=$this->load->view('menu_pimpinan/persetujuan_detail',$reservasiM,TRUE);
		// view layout with $data
		$this->load->view('layouts/sidebar_pimpinan',$data);
	}

    function keputusan($reservasi_id, $status): void
    {
        $this->pemimpin->keputusan($reservasi_id, $status);

		// Set notification to peminjam
		$type = match ($status) {
			'1' => 102,
			'2' => 103
		};

		// Notify pengelola when a reservation is approved
		if ($type == 102)
			$this->notification->setNotification(301, $reservasi_id);

		// Notify peminjam
		$this->notification->setNotification($type, $reservasi_id);

		redirect(base_url('cpimpinan/reservasiv'));
    }

    function lihatPDF($reservasi_id): void
    {
        $data = $this->pemimpin->getDocument($reservasi_id);
        $this->pdf->pdfPreview($data);
    }

}

?>
