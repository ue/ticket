<?php namespace App\Repositories;

use App\Models\Category as Model;

class Category {

    public function create($title)
    {
        $Category = new Model();
        $Category->title = $title;
        $Category->root_id = 12;
        $Category->save();
        return $Category;        
    }
    
}