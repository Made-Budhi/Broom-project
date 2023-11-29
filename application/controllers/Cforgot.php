<?php

/**
 * @property Mverif $verif
 */
class Cforgot extends CI_Controller
{

	/**
	 * Calling model for verification
	 */
	function forgot()
	{
		$this->load->model("Mverif", 'verif');
		$this->verif->simpanverif();
	}

}

