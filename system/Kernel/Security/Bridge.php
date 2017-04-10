<?php namespace Kernel\Security;

use Kernel\Connector;

/**
 * Bridge
 *
 * Her bir güvenlik kuralı bir "Bridge" olarak adlandırılır. 
 * Oluşturulacak her güvenlik kuralı bu sınıf üzerinden 
 * genişletilmelidir.
 *
 * @author    Özgür Adem Işıklı 		  <ozgur@polisoft.com.tr>
 * @copyright Polisoft Yazılım 			  
 * @license   http://www.polisoft.com.tr
 * @since     Release 1.0.0
 */
abstract class Bridge extends Connector {

    /**
     * This methos attempts that has passed 
     * the security rules
     *
     * @return boolean
     */
    abstract public function attempt();

}