<?php
	class Crooms extends CI_Controller
	{
		function tampil()
		{
			$this->load->model("Mrooms");
			$tampilgedung['hasil']=$this->Mrooms->tampilgedung();
			$data['konten'] = $this->load->view("roomlist", $tampilgedung, TRUE);
			$this->load->view("layouts/sidebar", $data);
		}
		
        function calendar($gedung)
		{
			$this->load->model("Mrooms");
			$tampildata['hasil']=$this->Mrooms->tampildata($gedung);
			$data = array(
				'tabel' => $this->load->view('schedule',$tampildata,TRUE),
				'gedung' => $gedung
			);
			// $data['tabel']=$this->load->view('schedule',$tampildata,TRUE);
			$this->load->view('calendar',$data);
		}

		function view(){
			$data = array(
				'gedung' => $this->input->get('gedung')
			);

			// echo $this->input->get('gedung');

			$this->load->view('calendar', $data);
		}
	}

        
?>