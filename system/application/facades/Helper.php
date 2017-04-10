<?php 

use Kernel\Facade;

class Helper extends Facade {

    /**
     * Get the connector name of main class
     *
     * @return string
     */
    public static function getFacadeAccessor() 
    { 
        return 'Kernel\Facades\Helper';
    }

}