<?php namespace App\Middleware\User;

use Kernel\Middleware\Middleware;

class getUser extends Middleware {

    /**
     * This method gets validation rules as an array
     *
     * @return array
     */
    public function getRules()
    {
        return [
            'id' => 'required|numeric'
        ];
    }   

}