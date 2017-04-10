<?php namespace App\Middleware\Turler;

use Kernel\Middleware\Middleware;

class Create extends Middleware {

    /**
     * This method gets validation rules as an array
     *
     * @return array
     */
    public function getRules()
    {
        return [
            'name' => 'required|min_length[4]'
        ];
    }


}