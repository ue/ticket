<?php namespace App\Security\Bridges;

use Kernel\Security\Bridge;
use App\Repositories\Token as TokenRepository;
use Kernel\Exceptions\AuthException;
use Input, Exception, Auth, Token as TokenFacade;

/**
 * TokenTime
 *
 * Token'ın uzatılması işlemini gerçekleştirir.
 *
 * @author    Özgür Adem Işıklı           <ozgur@polisoft.com.tr>
 * @copyright Polisoft Yazılım               
 * @license   http://www.polisoft.com.tr
 * @since     Release 1.0.0
 */
class TokenTime extends Bridge {

    /**
     * This methos attempts that has passed 
     * the security rules
     *
     * @return boolean
     */
    public function attempt()
    {
        // Repository örneği oluşturulur
        $repo = new TokenRepository();
        // Token bilgileri geçerliyse zaman eklenir
        $repo->addTimeToToken(TokenFacade::get());
        return true;
    }   

}