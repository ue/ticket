<?php namespace Kernel\Facades;

class Debug {

    /**
     * Debug messages
     *
     * @var array
     */
    private $messages = [];

    /**
     * Debug codes
     *
     * @var array
     */
    private $codes = [];

    /**
     * This method adds a new debug message 
     *
     * @param  string       $code
     * @param  string       $message
     * @return null
     */
    public function add($code, $message)
    {
        array_push($this->messages, $message);
        array_push($this->codes, $code);
    }

    /**
     * This method gets all messages 
     * 
     * @return array
     */
    public function get()
    {
        return $this->messages;
    }

    /**
     * This method gets all codes
     * 
     * @return array
     */
    public function getCodes()
    {
        return $this->codes;
    }

}