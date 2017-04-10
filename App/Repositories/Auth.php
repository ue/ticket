<?php namespace App\Repositories;

use App\Models\Token;
use Crypt, DateTime, DateInterval, Exception;

class Auth {

    /**
     * This method creates a new token for the personal 
     *
     * @param  string       $data
     * @return string
     */
    public function generateToken($data)
    {
        // Token zamanları ayarlanır
        $now = new DateTime(date('Y-m-d H:i:s'));
        $expired = new DateTime(date('Y-m-d H:i:s'));
        $expired->add(new DateInterval('PT'.getenv('token_minute').'M'));

        // Diğer tokenların hepsi silinir
        Token::where('personal_code', '=', $data->PersonelKodu)
             ->where('security_token', '=', Crypt::agentToken())
             ->delete();

        // Yeni bir token oluşturulur
        $token = new Token();
        $token->personal_code  = $data->PersonelKodu;
        $token->token          = Crypt::token($data->PersonelKodu);
        $token->security_token = Crypt::agentToken();
        $token->user_data      = json_encode($data);
        $token->expired_at     = $expired->format('Y-m-d H:i:s');
        $token->save();
        return $token->token;
    }

    /**
     * This method deletes the token that was sent 
     *
     * @param  string       $token 
     * @return null
     */
    public function deleteToken($token)
    {   
        try {
            $token = Token::where('token', '=', $token)->firstOrFail();
            return $token->delete();            
        } catch (Exception $e) {
            return false;
        }
    }

}