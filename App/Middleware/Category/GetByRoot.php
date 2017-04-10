<?php namespace App\Middleware\Category;

use Kernel\Middleware\Middleware;

class GetByRoot extends Middleware {

    /**
     * This method gets validation rules as an array
     *
     * @return array
     */
    public function getRules()
    {
        return [
            'rootId' => 'required|numeric'
        ];
    }


}