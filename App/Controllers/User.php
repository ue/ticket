<?php namespace App\Controllers;

use App\Security\Roles\Member;
use App\Models\User as Model;
use App\Repositories\User as Repository;
use Input;

class User extends Member {


	 public function getUser() {

    	$this->response->data(
            $this->repository->getUser(
                Input::get('id')
            )
        );
	 }


}
  