<?php namespace Kernel;

use Kernel\Exceptions\PermissionException;

/**
 * Controller
 *
 * Sistem içerisindeki tüm Controller sınıfları, bu sınıf 
 * üzerinden genişletilirler. Böylece ortak güvenlik politikası 
 * uygulanır. Ayrıca Request ve Response nesnelerine alt 
 * Controller sınıflarından ulaşmak kolaylaşır.
 *
 * @author    Özgür Adem Işıklı           <ozgur@polisoft.com.tr>
 * @copyright Polisoft Yazılım               
 * @license   http://www.polisoft.com.tr
 * @since     Release 1.0.0
 */
class Controller {

    /**
     * Request instance 
     *
     * @var Request
     */
    protected $request;

    /**
     * Response instance 
     *
     * @var Response
     */
    protected $response;

    /**
     * Class constructer 
     *
     * @param  Request      $request 
     * @param  Response     $response
     * @return null
     */
    public function __construct($request, $response)
    {
        $this->request  = $request;
        $this->response = $response;
        $this->callBridges();
    }

    /**
     * This method calls all bridges 
     *
     * @return null
     */
    private function callBridges()
    {
        foreach ($this->getBridges() as $key => $bridge) 
        {
            $bridge = 'App\Security\Bridges\\'.$bridge;
            $instance = new $bridge();
            if (!$instance->attempt())
            {
                throw new PermissionException('Yetkisiz işlem gerçekleştirdiniz.');
            }
        }
    }

}