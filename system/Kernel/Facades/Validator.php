<?php namespace Kernel\Facades;

use Input as InputFacade;
use Kernel\Exceptions\UserException;

class Validator  {

    /**
     * This method checks the input value that was selected 
     * by the key must be in array that was send as a argument 
     *
     * @param  string       $key 
     * @param  string       $title
     * @param  array        $array
     */
    public function inArray($key, $title, $array)
    {
        if (!in_array(InputFacade::get($key), $array)) 
        {
            throw new UserException("$title alanı için geçersiz bir seçim yaptınız.");
        }
    }

}