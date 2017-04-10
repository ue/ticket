    <?php namespace App\Controllers;

use App\Security\Roles\Anonymous;
use Input;

class Auth extends Anonymous {

    /**
     * This method attemps to login 
     *
     * @method POST 
     * @return null
     */
    public function login()
    {
        // Token oluşturuluyor 
        // $data->Token = $this->repository->generateToken($data);
        // Yanıt hazırlanıyor
        $this->response->data($data);
    }

    /**
     * This method creates the login 
     *
     * @method GET 
     * @return null
     */
    public function logout()
    {
        $this->repository->deleteToken(Input::token());
    }

}