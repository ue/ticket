<?php namespace Kernel\Loader;

class Decorator {

    /**
     * This method loads the class if it was defined 
     *
     * @param  array        $classes
     * @return null
     */
    public static function load($classes)
    {
        foreach ($classes as $connector => $arguments) 
        {
            $class = 'Kernel\\Loader\\'.ucfirst($connector);
            if (class_exists($class))
            {
                call_user_func_array([new $class, 'trigger'], $arguments);
            }
        }
    }

    /**
     * This method loads the class if it was defined 
     *
     * @param  string       $connector
     * @param  array        $arguments
     * @return mixed
     */
    public static function single($connector, $arguments = array())
    {
        $class = 'Kernel\\Loader\\'.ucfirst($connector);
        if (class_exists($class))
        {
            return call_user_func_array([new $class, 'trigger'], $arguments);
        }
    }    
    
}