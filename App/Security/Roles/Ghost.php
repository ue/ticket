<?php namespace App\Security\Roles;

use Kernel\Security\Role;

/**
 * Roles\Ghost
 *
 * Sisteme üye olan kullanıcıların sahip oldukları roldür. Ancak 
 * Member rolünden farkı, token kontrolü sonrası tokenın süresi 
 * uzatılmaz.
 *
 * @author    Özgür Adem Işıklı           <ozgur@polisoft.com.tr>
 * @copyright Polisoft Yazılım               
 * @license   http://www.polisoft.com.tr
 * @since     Release 1.0.0
 */
class Ghost extends Role {

    /**
     * This methos gets all bridges as an array 
     *
     * @return array
     */
    public function getBridges()
    {
        return ['Token'];
    }

}