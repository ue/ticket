<?php namespace Kernel\Exceptions;

use Lang;

class NotFoundException extends AppException {

    protected $message;

    /**
     * Class constructer 
     *
     * @return null
     */
    public function __construct()
    {
        parent::__construct();
        $this->message = Lang::get('NotFoundException');
    }

}