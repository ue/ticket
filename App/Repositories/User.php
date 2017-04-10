<?php namespace App\Repositories;

use App\Models\User as Model;

class User {

    public function create($name)
    {
        $user = new Model();
        $user->name = $name;
        $user->save();
        return $user;        
    }
    
}