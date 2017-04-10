<?php namespace Kernel\Facades;

use Kernel\Exceptions\UserException;
use Lang;

class DB {

    /**
     * Capsule Manager 
     *
     * @var Capsule
     */
    private $capsule;

    /**
     * Query result 
     *
     * @var array
     */
    private $result;

    /**
     * This method sets the capsule 
     *
     * @param  object       $capsule 
     * @return null
     */
    public function setCapsule($capsule)
    {
        $this->capsule = $capsule;
    }

    /**
     * This method gets the connection 
     *
     * @return object
     */
    public function getConnection()
    {
        return $this->capsule->getDatabaseManager()->connection();
    }

    /**
     * This method execs the sql query on the database with 
     * all arguments 
     * 
     * @param  string       $sql 
     * @param  array        $arguments
     * @return self
     */
    public function query($sql, $arguments = array())
    {
        $this->result = $this->getConnection()->select($sql, $arguments);
        return $this;
    }

    /**
     * This method gets result if the error wasnt defined
     *
     * @return object
     */
    public function getOrFail()
    {
        $message = Lang::get('NotFoundException');
        if (count($this->result) === 0)
        {
            throw new UserException($message);
        }

        if (isset($this->result[0]))
        {   
            if (!isset($this->result[0]->error_text))
            {
                return $this->result;
            }
            $message = $this->result[0]->error_text;
        }
        throw new UserException($message);
    }

    /**
     * This method gets the result object
     *
     * @return object
     */
    public function get()
    {
        return $this->result;
    }
    
}