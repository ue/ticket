<?php namespace Kernel\Loader;

use Debug;

class Middleware implements LoaderInterface {

    /**
     * This method is the trigger method that is called by 
     * the decorator class
     *
     * @return null
     */
    public function trigger()
    {
        list($request) = func_get_args();
        $middleware = $request->getMiddleware();
        if (class_exists($middleware))
        {
            Debug::add("debug::middleware", "Middleware katmanı kontrolleri yapılıyor.");
            $middleware = new $middleware();
            if (get_parent_class($middleware) === 'Kernel\Middleware\Middleware')
            {
                // Classical validation
                $middleware->run();
           }
        }
    }
    
}