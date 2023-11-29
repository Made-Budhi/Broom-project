<?php
	class Cforgor extends CI_Controller
	{
		function forgor()
		{
			$this->load->model("Mverif");
			$this->Mverif->simpanverif();
		}
		
	}
?>