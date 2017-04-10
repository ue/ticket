<?php namespace App\Repositories;

use App\Models\Token as TokenModel;
use DB, Crypt, DateTime, DateInterval;

class Token {

    /**
     * This method checks the token
     *
     * @param  string       $token
     * @return user
     */
    public function getToken($token)
    {
        // Token kontrol edilir
        return TokenModel::where('token', '=', $token)
                         ->where('security_token', '=', Crypt::agentToken())
                         ->where('expired_at', '>', date('Y-m-d H:i:s'))
                         ->firstOrFail();
    }

    /**
     * This method adds the time to token
     *
     * @param  object       $token 
     * @return null
     */
    public function addTimeToToken($token)
    {
        // Yeni son kullanım tarihi oluşturulur
        $expired = new DateTime(date('Y-m-d H:i:s'));
        $expired->add(new DateInterval('PT'.getenv('token_minute').'M'));
        $token->expired_at = $expired->format('Y-m-d H:i:s');
        $token->save();
    }

}