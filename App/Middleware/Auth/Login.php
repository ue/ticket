<?php namespace App\Middleware\Auth;

use Kernel\Middleware\Middleware;

class Login extends Middleware {

    /**
     * This method gets validation rules as an array
     *
     * @return array
     */
    public function getRules()
    {
        return [
            'username' => 'required|min_length[4]',
            'password' => 'required|max_length[20]'
        ];
    }

}