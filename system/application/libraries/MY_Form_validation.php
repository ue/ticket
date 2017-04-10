<?php

class MY_Form_validation extends CI_Form_validation {

    /**
     * Class constructer 
     *
     * @param  array        $config 
     * @return null
     */
    function __construct($config = array())
    {
        parent::__construct($config);
        Input::put('MY_Form_validation', true);
    }

    /**
     * Error Array
     *
     * Returns the error messages as an array
     *
     * @return  array
     */
    function getErrors()
    {
        $OBJ =& _get_validation_object();
        $messages = [];
        foreach ($OBJ->_error_array as $key => $value) 
        {
            array_push($messages, $value);
        }
        return $messages;
    }

}