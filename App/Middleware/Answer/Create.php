<?php namespace App\Middleware\Answer;

use Kernel\Middleware\Middleware;

class Create extends Middleware {


    public function getRules()
    {
        return [
            'content' => 'required'
        ];
    }


}