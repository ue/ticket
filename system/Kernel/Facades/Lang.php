<?php namespace Kernel\Facades;

use CI as CIFacade;

class Lang {

    /**
     * This method gets the value of the item that was 
     * select by the key
     *
     * @param  string       $key
     * @return string
     */
    public function get($key)
    {
        return CIFacade::lang($key);
    }
   
}