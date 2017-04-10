<?php namespace Kernel\HTTP;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Kernel\Exceptions\AppException;
use Kernel\Exceptions\ArgumentException;
use Kernel\Exceptions\NotFoundException;
use Kernel\Loader\Decorator as Loader;
use Kernel\Connector;
use Exception, Debug;

/**
 * Router
 *
 * Bu sınıf asıl rotalama işlemini gerçekleştirmektedir. 
 * Tüm katmanları ayağa kaldıran bu bölümdür.
 *
 * @author    Özgür Adem Işıklı           <ozgur@polisoft.com.tr>
 * @copyright Polisoft Yazılım               
 * @license   http://www.polisoft.com.tr
 * @since     Release 1.0.0
 */
class Router extends Connector {

    /**
     * Request 
     *
     * @var Request
     */
    private $request;

    /**
     * Response 
     *
     * @var Response
     */
    private $response;

    /**
     * Class constructer
     *
     * @param  Request          $request
     * @param  Response         $response
     * @return null
     */
    public function __construct(Request     $request,
                                Response    $response)
    {
        parent::__construct();
        Loader::single('Database');
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * This method calls the route 
     *
     * @return null
     */
    public function call()
    {
        // Root request is being checking.
        if ($this->request->isTheRoot())
        {
            return $this->response->get();
        }
        try {
            // Getting the instance
            Debug::add("debug::controller", "Controller örneği oluşturuluyor.");
            $this->instance = $this->getControllerInstance();
            // Middleware katmanı çağırılıyor.
            Loader::load(['Middleware' => [$this->request]]);
            // Getting repository
            $this->instance->repository = $this->getRepositoryInstance();
            // Getting services
            $this->instance->service = $this->getServiceInstance();
            
            // Calling all loaders and checkers
            Loader::load([
                'Method\ExistChecker' => [$this->instance, $this->request]
            ]);
            // Calling the method
            Debug::add("debug::method", "Controller metodu çağırılıyor.");
            call_user_func_array(
                [$this->instance, $this->request->getAction()],
                $this->request->getArguments()
            );
            // Sonuçlar filtrelenir.
            Loader::load([
                'Filter' => [$this->request, $this->response]
            ]);
            $this->response->get();
        } catch (ArgumentException $e) {
            return $this->response->setErrors(
                'ArgumentException', $this->CI->form_validation->getErrors()
            )->get();
        } catch (AppException $e) {
            log_message('error', $e->getMessage());
            return $this->response->error($this->getExceptionClass($e), $e->getMessage())->get();
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->error('Exception', $e->getMessage())->get();
        }        
    }   

    /**
     * This method gets the exception class 
     *
     * @param  Exception       $exception
     * @return string
     */
    private function getExceptionClass($exception)
    {
        return str_replace('Kernel\Exceptions\\', '', get_class($exception));
    }

    /** 
     * This method gets the repository instance if it was defined 
     *
     * @return object
     */
    private function getRepositoryInstance()
    {
        if (class_exists($this->request->getRepository()))
        {
            Debug::add("debug::repository", "Repository örneği oluşturuluyor.");
            $name = $this->request->getRepository();
            return new $name;
        }
    }

    /** 
     * This method gets the repository instance if it was defined 
     *
     * @return object
     */
    private function getServiceInstance()
    {
        if (class_exists($this->request->getService()))
        {
            Debug::add("debug::service", "Service örneği oluşturuluyor.");
            $name = $this->request->getService();
            return new $name;
        }
    }

    /**
     * This method gets the instance of controller
     *
     * @return CI_Controller
     */
    private function getControllerInstance()
    {
        if (!class_exists($this->request->getClass()))
        {
            throw new NotFoundException('404 Not Found!');
        }
        $class = $this->request->getClass();
        return new $class($this->request, $this->response);
    }
    
}