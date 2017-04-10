<?php namespace Kernel\Facades;

use Kernel\Connector;

class CI extends Connector {

    /**
     * Input
     *
     * @return Input
     */
    public function input()
    {
        return $this->CI->input;
    }
    
    /**
     * Agent connector 
     *
     * @return Agent
     */
    public function agent()
    {
        return $this->CI->agent;  
    }

    /**
     * Encrypt connector 
     *
     * @return Encrypt
     */
    public function encrypt()
    {
        return $this->CI->encrypt;
    }

    /**
     * Config connector 
     *
     * @return Config
     */
    public function config()
    {
        return $this->CI->config;
    }

    /**
     * Gets the language connector 
     *
     * @param  string        $key 
     * @return string
     */
    public function lang($key)
    {
        return $this->CI->lang->line($key);
    }

    /**
     * Gets the language connector 
     *
     * @param  string       $file 
     * @param  string       $language
     * @return null
     */
    public function loadLang($file, $language)
    {
        $this->CI->lang->load($file, $language);
    }

}