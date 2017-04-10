<?php namespace Kernel\Facades;

use Exception;

class Option {

    /**
     * This method gets the option by the item 
     *
     * @param  string       $item 
     * @return mixed 
     */
    public function get($item)
    {
        $instance = $this->getInstance($item);
        return $instance->get();
    }

    /**
     * This method gets the option by the item 
     *
     * @param  string       $item 
     * @param  mixed        $value
     * @return mixed 
     */
    public function put($item, $value)
    {
        $instance = $this->getInstance($item);
        return $instance->put($value);
    }

    /**
     * This method gets the instance
     *
     * @param  string       $item 
     * @return object
     */
    private function getInstance($item)
    {
        $class = '\App\Options\\'.ucfirst($item);
        if (!class_exists($class)) 
        {
            throw new Exception("Option not found: $class");
        }
        return new $class();
    }
    
}