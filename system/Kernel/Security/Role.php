<?php namespace Kernel\Security;

use Kernel\Controller;

/**
 * Role 
 * 
 * Kullanıcı istekleri rollere göre gruplandırılmıştır. 
 * Bu sayede Controller sınıfları çok çeşitli olarak 
 * güvenlik kontrollerinden geçirilebilmektedir. Tek 
 * yapılması gereken Bridge tanımlarının yapılmasıdır.
 *
 * @author    Özgür Adem Işıklı 		  <ozgur@polisoft.com.tr>
 * @copyright Polisoft Yazılım 			  
 * @license   http://www.polisoft.com.tr
 * @since     Release 1.0.0
 * @see 	  App\Roles\Member
 */
abstract class Role extends Controller {

    /**
     * This methos gets all bridges as an array 
     *
     * @return array
     */
    abstract public function getBridges();

}