<?php namespace Kernel\Facades;

use Lcobucci\JWT\Builder;
use CI as CIFacade;

class Crypt {

    /**
     * This method hashs the password 
     *
     * @param  string       $value
     * @return string
     */
    public function password($value)
    {
        return hash("sha256", md5(sha1(md5(md5($value)))).getenv('encryption_key'));
    }

    /**
     * This method generates a new token 
     *
     * @param  string       $value
     * @return string
     */
    public function token($value = 'c6ffe6c14c37497c80e44e9d8a014c50')
    {
        /**
         * Bu bölüm altında JWT protokolü ile token oluşturuluyor.
         *
         * @see https://github.com/lcobucci/jwt
         * @see http://jwt.io/
         */
        return (string) (new Builder())->setIssuer(getenv('domain')) // Configures the issuer (iss claim)
                        ->setAudience(getenv('domain')) // Configures the audience (aud claim)
                        ->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
                        ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
                        ->setNotBefore(time()) // Configures the time that the token can be used (nbf claim)
                        ->setExpiration(time() + 3600) // Configures the expiration time of the token (nbf claim)
                        ->set('uid', 1) // Configures a new claim, called "uid"
                        ->getToken(); // Retrieves the generated token
        // Bu bölüm iptal edilmiş durumda
        return md5(uniqid(mt_rand(), true)).hash("sha256", md5(sha1(md5(md5($value)))).getenv('encryption_key'));
    }

    /**
     * This method gets the agent token by the client 
     * that was sent the request 
     *
     * @return string
     */
    public function agentToken()
    {
        return $this->mix(CIFacade::input()->ip_address()).
               $this->mix(CIFacade::agent()->agent_string());
    }

    /**
     * This method mixs the value 
     *
     * @param  string        $value 
     * @return string
     */
    public function mix($value)
    {
        return md5(sha1(md5(md5($value))));
    }

    /**
     * This method encodes the string 
     *
     * @param  string       $value 
     * @return string 
     */
    public function encode($value)
    {
        return CI::encrypt()->encode($value);
    }

    /**
     * This method decodes the string 
     *
     * @param  string       $value 
     * @return string 
     */
    public function decode($value)
    {
        return CI::encrypt()->decode($value);
    }
    
}