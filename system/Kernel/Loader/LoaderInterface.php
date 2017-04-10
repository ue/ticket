<?php namespace Kernel\Loader;

interface LoaderInterface {

    /**
     * This method is the trigger method that is called by 
     * the decorator class
     *
     * @return null
     */
    public function trigger();
    
}