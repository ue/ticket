<?php namespace Kernel\Facades;

/**
 * Token 
 *
 * @author    Özgür Adem Işıklı           <ozgur@polisoft.com.tr>
 * @copyright Polisoft Yazılım               
 * @license   http://www.polisoft.com.tr
 * @since     Release 1.0.0
 */
class Token {

    /**
     * Token object
     *
     * @var object
     */
    private $value = null;

    /**
     * This method sets the token 
     *
     * @return boolean
     */
    public function set($value)
    {
        $this->value = $value;
    }

    /**
     * This method gets the token
     *
     * @return object
     */
    public function get()
    {
        return $this->value;
    }
    
}