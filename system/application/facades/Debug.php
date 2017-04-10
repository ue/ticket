<?php 

use Kernel\Facade;

class Debug extends Facade {

    /**
     * Get the connector name of main class
     *
     * @return string
     */
    public static function getFacadeAccessor() 
    { 
        return 'Kernel\Facades\Debug';
    }

}