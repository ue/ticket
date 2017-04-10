<?php namespace App\Middleware\Answer;

use Kernel\Middleware\Middleware;

class GetById extends Middleware {

    public function getRules()
    {
        return [
            'question_id' => 'required|numeric'
        ];
    }


}