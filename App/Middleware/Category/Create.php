<?php namespace App\Middleware\Category;

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
            'title' => 'required'
        ];
    }


}