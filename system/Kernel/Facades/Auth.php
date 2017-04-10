<?php namespace Kernel\Facades;

class Auth {

    /**
     * User object
     *
     * @var object
     */
    private $user = null;

    /**
     * User's informations
     *
     * @var object
     */
    private $data = null;

    /**
     * This method checks the user was logged 
     *
     * @return boolean
     */
    public function check()
    {
        return $this->user !== null;
    }

    /**
     * This method sets the user 
     *
     * @param  object       $user 
     * @param  string       $data
     * @return null
     */
    public function set($user, $data)
    {
        $this->user = $user;
        $this->data = json_decode($data);
        if (isset($this->user->password))
        {
            unset($this->user->password);
        }
    }

    /**
     * This method gets the data of the user that was logged 
     *
     * @param  string       $key
     * @return mixed
     */
    public function data($key = false)
    {
        if ($key === false) 
        {
            return $this->data;
        }

        if (isset($this->data->{$key}))
        {
            return $this->data->{$key};
        }
    }

    /**
     * This method gets the user 
     *
     * @return object
     */
    public function current()
    {
        return $this->user;
    }

    /**
     * This method gets the value of selected key 
     * by the current user 
     *
     * @param  string       $key 
     * @return mixed  
     */
    public function get($key)
    {   
        if ($this->user === null)
        {
            return;
        }

        if (!isset($this->user->{$key}))
        {
            return;
        }

        return $this->user->{$key};
    }
    
}