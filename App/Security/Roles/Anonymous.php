<?php namespace App\Security\Roles;

use Kernel\Security\Role;

/**
 * Anonymous
 *
 * Henüz oturum açmamış kullanıcıların rolüdür.
 *
 * @author    Özgür Adem Işıklı           <ozgur@polisoft.com.tr>
 * @copyright Polisoft Yazılım               
 * @license   http://www.polisoft.com.tr
 * @since     Release 1.0.0
 */
class Anonymous extends Role {

    /**
     * This methos gets all bridges as an array 
     *
     * @return array
     */
    public function getBridges()
    {
        return [];
    }

}