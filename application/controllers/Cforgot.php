<?php
	class Cforgot extends CI_Controller
	{

		/**
		 * calling model for verification
		 */
		function forgor()
		{
			$this->load->model("Mverif");
			$this->Mverif->simpanverif();
		}
		
	}
?>