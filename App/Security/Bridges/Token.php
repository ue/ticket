<?php namespace App\Security\Bridges;

use Kernel\Security\Bridge;
use App\Repositories\Token as TokenRepository;
use Kernel\Exceptions\AuthException;
use Input, Exception, Auth, Token as TokenFacade;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;

/**
 * Token
 *
 * İlgili isteğin bir token içerip içermediği kontrol edilir. 
 * Eğer token içermiyorsa bu bir geçersiz istektir ve bu durum 
 * bir üst bölüme iletilir.
 *
 * @author    Özgür Adem Işıklı           <ozgur@polisoft.com.tr>
 * @copyright Polisoft Yazılım               
 * @license   http://www.polisoft.com.tr
 * @since     Release 1.0.0
 */
class Token extends Bridge {

    /**
     * This methos attempts that has passed 
     * the security rules
     *
     * @return boolean
     */
    public function attempt()
    {
        try {
            // Token String alınır
            $tokenString = Input::token();

            // JWT kontrolü
            $token = (new Parser())->parse((string) $tokenString); // Parses from a string
            $token->getHeaders(); // Retrieves the token header
            $token->getClaims(); // Retrieves the token claims
            $data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)
            $data->setIssuer(getenv('domain'));
            $data->setAudience(getenv('domain'));
            $data->setId('4f1g23a12aa');
            if ($token->validate($data) === false) {
                throw new Exception();
            }

            // Repository örneği oluşturulur
            $repo = new TokenRepository();
            // Token bilgileri alınır
            $token = $repo->getToken($tokenString);
            // Token bilgileri erişilebilir yapılır
            TokenFacade::set($token);
            // Kullanıcı kodu güncellenir.
            Auth::set($token->personal_code, $token->user_data);
        } catch (Exception $e) {
            throw new AuthException();
        }
        return true;
    }   

}