<?php namespace App\Controllers;

use App\Security\Roles\Member;
use App\Repositories\Answer as Repository;
use Input, Auth;

class Answer extends Member {
	
    public function create()
    {
        $repository = new Repository();
        $this->response->data(
            $this->repository->create(
                Input::get('content'), 
                Input::get('question_id'),
                Auth::get('id')

            )
        );
    }

    public function getById()
    {
       $repository = new Repository();
       $this->response->data(
           $repository->getById(Input::get('question_id')) 
        );
    }

    public function update()
    {
        $repository = new Repository();
        $this->response->data(
            $repository->update(
                Input::get('id'),
                Input::get('closed_at')
            )
        );
    }




}