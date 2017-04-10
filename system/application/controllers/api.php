<?php

use Kernel\HTTP\Response;
use Kernel\HTTP\Request;
use Kernel\HTTP\Router;

class Api extends CI_Controller {

    /**
     * This method is a remapper method 
     *
     * @return null
     */
    public function _remap() 
    {
        $router = new Router(new Request, new Response);
        $router->call();
    }

}