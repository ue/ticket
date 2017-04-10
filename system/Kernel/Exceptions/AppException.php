<?php namespace Kernel\Exceptions;

use Exception;

class AppException extends Exception {

    protected $message = 'Uygulama hatası.';

}