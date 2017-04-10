<?php namespace App\Controllers;

use App\Security\Roles\Ghost;

class Security extends Ghost {

    /**
     * This method gets all users
     * 
     * @return  json
     */
    public function auth()
    {
        // There is no task that we have to do it.
        // If the request can be access this method, everything 
        // is fine. That is the security test to checking token 
    }

}