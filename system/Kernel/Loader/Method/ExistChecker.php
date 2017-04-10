<?php namespace Kernel\Loader\Method;

use Kernel\Exceptions\NotFoundException;
use Kernel\Loader\LoaderInterface;

class ExistChecker implements LoaderInterface {

    /**
     * This method is the trigger method that is called by 
     * the decorator class
     *
     * @return null
     */
    public function trigger()
    {
        list($instance, $request) = func_get_args();
        if (!method_exists($instance, $request->getAction()))
        {
            throw new NotFoundException('404 Method Not Found!');
        }
    }
    
}