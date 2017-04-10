<?php namespace App\Security\Roles;

use Kernel\Security\Role;

/**
 * Role\Member
 *
 * Üye olan kullanıcıların sahip oldukları roldür.
 *
 * @author    Özgür Adem Işıklı           <ozgur@polisoft.com.tr>
 * @copyright Polisoft Yazılım               
 * @license   http://www.polisoft.com.tr
 * @since     Release 1.0.0
 */
class Member extends Role {

    /**
     * This methos gets all bridges as an array 
     *
     * @return array
     */
    public function getBridges()
    {
        return [
                'Token',
                'TokenTime'
            ];
    }

}