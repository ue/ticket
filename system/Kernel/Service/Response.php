<?php namespace Kernel\Service;

/**
 * Response
 *
 * Web servislerden dönen response objesinin sınıfıdır. 
 * Response doğrudan bir object olarak değil, class olarak 
 * verilmektedir. Böylece ilgili response ile ilgili işlemler 
 * metotlar kullanılarak yapılabilmektedir.
 *
 *      $response = new Response();
 *      $response->hasError();
 * 
 * @author    Özgür Adem Işıklı           <ozgur@polisoft.com.tr>
 * @copyright Polisoft Yazılım               
 * @license   http://www.polisoft.com.tr
 * @since     Release 1.0.0
 */
class Response {

    /**
     * Response object 
     *
     * @return object
     */
    private $response;

    /**
     * Class constructer 
     *
     * @param  string       $response       [optional]
     * @return null
     */
    public function __construct($response = null)
    {
        if ($response !== null) 
        {
            $this->response = json_decode(json_encode($response));            
        } 
        else 
        {
            $this->response = json_decode('{"HataKodu":0, "HataMesaji":"", "JSONData":"{}", "OtherData":""}');
        }
    }

    /**
     * This method checks and an error was occurred or not 
     *
     * @return boolean
     */
    public function hasError()
    {
        if ($this->response->HataKodu === 0) 
        {
            // Hata yok
            return false;
        }
        // Hata var
        return true;
    }

    /**
     * This method gets the error message 
     *
     * @return string 
     */
    public function getErrorMessage()
    {
        return $this->response->HataMesaji;
    }   

    /**
     * This method gets the error code 
     *
     * @return integer 
     */
    public function getErrorCode()
    {
        return $this->response->HataKodu;
    }

    /**
     * This method gets the response
     *
     * @return object
     */
    public function get()
    {
        return $this->response;
    }

    /**
     * This method gets the item of the JSONData
     *
     * @param  string        $key 
     * @return object
     */
    public function item($key)
    {
        if (!isset($this->response->JSONData))
        {
            return [];
        }

        if (!is_object($this->response->JSONData))
        {
            $this->response->JSONData = json_decode($this->response->JSONData);
        }

        if (!isset($this->response->JSONData->{$key}))
        {
            return [];
        }

        return $this->response->JSONData->{$key};
    }

    /**
     * This method converts the data to json object 
     *
     * @param  array        $data 
     * @return object
     */
    protected function toJson($data)
    {
        return json_decode($data->JSONData);
    }

}