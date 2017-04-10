<?php namespace Kernel\Facades;

use Kernel\Connector;

class Input extends Connector {

    /**
     * Getting input variable from post or get 
     *
     * This function will search through both the post 
     * and get streams for data, looking first in post, and then in get.
     * 
     * @param  string       $key 
     * @param  string       $default        [optional]
     * @return string
     */
    public function get($key, $default = false)
    {
        $value = $this->CI->input->get_post($key);
        
        if ($value === false) 
        {
            $value = null;
        }

        if ($value === null && $default !== false) 
        {
            $value = $default;
        }
        return $value;
    }

    /**
     * This method gets items that were selected by array 
     *
     * @param  array        $items 
     * @return array
     */
    public function only($items)
    {
        $data = [];
        foreach ($items as $key => $item) 
        {
            $data[$item] = $this->get($item);
        }
        return $data;
    }

    /**
     * This method gets all headers as array 
     *
     * @return array
     */
    public function headers()
    {
        return $this->CI->input->request_headers(); 
    }

    /**
     * This method gets the active token 
     *
     * @return string
     */
    public function token()
    {
        // Header data is being checked
        return $this->getFromHeader('Token');
    }

    /**
     * This method gets the language from header 
     *
     * @return string
     */
    public function language()
    {
        return $this->getFromHeader('language');        
    }

    /**
     * This method gets the active token 
     *
     * @return string
     */
    public function getFromHeader($item)
    {
        // Header data is being checked
        $headers = $this->headers();
        if (isset($headers[strtolower($item)]))
        {
            return $headers[strtolower($item)];
        }

        if (isset($headers[ucfirst($item)]))
        {
            return $headers[ucfirst($item)];
        }
    }


    /**
     * Setting input value by selected key 
     *
     * @param  string       $key 
     * @param  string       $value 
     * @return null
     */
    public function put($key, $value)   
    {
        $_POST[$key] = $value;
    }

    /**
     * Getting all input variables
     *
     * @return array
     */
    public function all()
    {
        $inputDatas = [];
        foreach ($_POST as $key => $value) {
            $inputDatas[$key] = $this->get($key);
        }
        return $inputDatas;
    }
    
}