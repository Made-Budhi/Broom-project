<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Mpemimpin $pemimpin
 * @property Mpdf $pdf
 */

class Cpemimpin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mpemimpin', 'pemimpin');
        $this->load->model('Mpdf', 'pdf');
    }

    function reservasiV(): void
	{
		// add variable and get DATABASE reservasi
		$reservasiM['hasil'] = $this->pemimpin->pesetujuan();
		// add variable TO Load Dashboard and put DATABASE from resevasi to table
        $data['content']=$this->load->view('persetujuan_pemimpin',$reservasiM,TRUE);
		// view layout with $data
		$this->load->view('layouts/sidebar_pimpinan',$data);
	}

    function detailV($reservasi_id): void
	{
		// add variable and get DATABASE reservasi
		$reservasiM['hasil'] = $this->pemimpin->lengkap($reservasi_id);
		// add variable TO Load Dashboard and put DATABASE from resevasi to table
        $data['content']=$this->load->view('persetujuan_detail',$reservasiM,TRUE);
		// view layout with $data
		$this->load->view('layouts/sidebar_pimpinan',$data);
	}

    function keputusan($reservasi_id, $status): void
    {
        $this->pemimpin->keputusan($reservasi_id, $status);
		// add variable TO Load Dashboard and put DATABASE from resevasi to table
        $data['konten']=$this->load->view('persetujuan_pemimpin', array(), TRUE);
		// view layout with $data
		$this->load->view('layouts/sidebar_pimpinan',$data);
    }

    function lihatPDF($reservasi_id): void
    {
        $data = $this->pemimpin->getDocument($reservasi_id);
        var_dump($data);
        $this->pdf->pdfPreview($data);
    }


}

?>