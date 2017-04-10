<?php namespace App\Middleware\Category;

use Kernel\Middleware\Middleware;

class Update extends Middleware {

    /**
     * This method gets validation rules as an array
     *
     * @return array
     */
    public function getRules()
    {
        return [
            'name' => 'required'
        ];
    }

}