<?php

use App\Repositories\Token;

class Main extends CI_Controller {

    /**
     * Index action 
     *
     * @return view
     */
    public function index()
    {
        $this->load->view('index');
    }

}