<?php

class Cregister extends CI_Controller 
{
    public function __construct()
        {
            parent::__construct();
            $this->load->model('mregister');
        }    

    public function regis()
        {
            $this->mregister->regis();
        }

}

?>