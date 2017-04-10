<?php namespace App\Controllers;

use App\Security\Roles\Anonymous;
use Input;

class Question extends Anonymous
{
    public function create()
    {
        $this->repository->create(Input::get('contents') , Input::get('categorie_id'));
    }

    public function get()
    {

    	$this->response->data($this->repository->get());
    }
}
 