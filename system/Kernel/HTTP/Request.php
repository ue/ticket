<?php namespace Kernel\HTTP;

use Exception, Input;

/**
 * Request
 *
 * Kullanıcı isteği sonucunda sistem içerisinde oluşan dinamikler 
 * bu sınıf aracılığı ile yönetilmektedir.
 *
 * @author    Özgür Adem Işıklı           <ozgur@polisoft.com.tr>
 * @copyright Polisoft Yazılım               
 * @license   http://www.polisoft.com.tr
 * @since     Release 1.0.0
 */
class Request {

    /**
     * Class string 
     *
     * @var string
     */
    private $class = 'App\\Controllers';

    /**
     * Middleware namespace 
     *
     * @var string
     */
    private $middleware = 'App\\Middleware';

    /**
     * Repositories namespace 
     *
     * @var string
     */
    private $repositories = 'App\\Repositories';

    /**
     * Filters namespace 
     *
     * @var string
     */
    private $filter = 'App\\Filters';

    /**
     * Service namespace 
     *
     * @var string
     */
    private $service = 'App\\Services';

    /**
     * Action
     *
     * @var string
     */
    private $action;

    /**
     * Arguments
     *
     * @var array
     */
    private $arguments = [];

    /**
     * URL 
     *
     * @var string
     */
    private $url;

    /**
     * Class constructer
     *
     * @return null
     */
    public function __construct()
    {
        // Predefinations are done 
        $this->url = str_replace('api/', '', uri_string());
        $parts = [];

        if (Input::getFromHeader('Test') === 'CodeCeption')
        {
            define('CodeCeption', true);
        }

        $found = false;
        /*
         * In this sections, the url seperate by the slash. 
         * Every part of the url is called as an item. 
         * This part searchs and item that is an integer. 
         * If the part is an integer, this part and afters parts 
         * of the part are arguments. So, we have an array that 
         * is called "$this->arguments". We push the part to the 
         * array.
         */
        foreach (explode('/', $this->url) as $key => $item) 
        {
            // Checking an argument was found before
            // or the part is an argument
            if ($found === true || is_numeric($item))
            {
                // Setting new argument
                $found = true;
                array_push($this->arguments, $item);
            } 
            else 
            {
                // It is not an argument. It is a namespace 
                // item. So, we set the item as a namespace.
                array_push($parts, $item);
                $this->middleware .= '\\'.ucfirst($item);
                $this->filter .= '\\'.ucfirst($item);
            }
        }

        // Namespace is found
        foreach ($parts as $key => $item) 
        {
            if ($key < count($parts) - 1)
            {
                $this->class .= '\\'.ucfirst($item);
                $this->repositories .= '\\'.ucfirst($item);
                $this->service .= '\\'.ucfirst($item);
            }
        }

        // Setting the action
        $this->action = $parts[count($parts) - 1];
    }

    /**
     * This method checks the request is the main request 
     *
     * @return boolean
     */
    final public function isTheRoot()
    {
        if ($this->class === 'App\Controllers')
        {
            return true;
        }
        return false;
    }

    /**
     * This method gets the class name 
     *
     * @return string
     */
    final public function getClass()
    {
        return $this->class;
    }

    /**
     * This method gets the namespace of the middleware
     *
     * @return string
     */
    final public function getMiddleware()
    {
        return $this->middleware;
    }

    /**
     * This method gets the repository name 
     *
     * @return string
     */
    final public function getRepository()
    {
        return $this->repositories;
    }

    /**
     * This method gets the service name 
     *
     * @return string
     */
    final public function getService()
    {
        return $this->service;
    }

    /**
     * This method gets the filter name 
     *
     * @return string
     */
    final public function getFilter()
    {
        return $this->filter;
    }

    /**
     * This method gets the action name 
     *
     * @return string
     */
    final public function getAction()
    {
        return $this->action;
    }

    /**
     * This method gets all arguments
     *
     * @return string
     */
    final public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * This method sets the annotations
     *
     * @return array
     * @deprecated
     */
    public function getAnnotations()
    {
        throw new Exception('Annotation isteme hatası. Bu özellik kaldırıldı.');
    }

    /**
     * This method sets the annotations
     *
     * @param  array        $value 
     * @return null
     * @deprecated
     */
    public function setAnnotations($value)
    {
        throw new Exception('Annotation güncelleme hatası. Bu özellik kaldırıldı.');
    }

    /**
     * This method gets the full URL
     *
     * @return string
     */
    final public function getUrl()
    {
        return $this->url;
    }
    
}