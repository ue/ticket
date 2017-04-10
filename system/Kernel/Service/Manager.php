<?php namespace Kernel\Service;

use SoapClient, Exception, SoapFault, CI, Debug, Input;
use Kernel\Exceptions\ServiceException;

/**
 * Manager
 *
 * Bu sınıfta servislerin yönetimi yapılmaktadır. 
 * Örneğin sistem üzerinden bir çok farklı web servis
 * kullanılabilir. Tüm bu servislerin sadece tanımları
 * yapıldıktan sonra bu sınıf aracılı ile kullanılması 
 * mümkündür.
 *
 * @author    Özgür Adem Işıklı           <ozgur@polisoft.com.tr>
 * @copyright Polisoft Yazılım               
 * @license   http://www.polisoft.com.tr
 * @since     Release 1.0.0
 */
class Manager {

    /**
     * Service Connections 
     *
     * @var array
     */
    private $connections;

    /**
     * Service types 
     *
     * @var array
     */
    private $types;

    /**
     * This method gets the connection if it was defined 
     *
     * @param  string       $name 
     * @return object
     */
    protected function connection($name)
    {
        if (isset($this->connections[$name]))
        {
            return $this->connections[$name];
        }

        $services = $this->getServices();
        if (isset($services[$name]))
        {
            $this->connections[$name] = new $services[$name]['type']($services[$name]['url']);   
            Debug::add("debug::service", "({$name}) isimli servisle bağlantı kuruldu.");
            return $this->connections[$name];
        }

        throw new Exception("Service not found: $name");
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

    /**
     * This method gets the response by the request
     *
     * @param  string       $name
     * @param  string       $method
     * @param  array        $arguments
     * @return object
     */
    public function call($name, $method, $arguments = [])
    {
        // Debug notu kaydediliyor
        Debug::add("debug::service.method", "({$name}) isimli servisin <<{$method}>> isimli metodu çağrıldı");
        /* Eğer bu bir test işlemi iste CodeCeption sabitinin daha 
         * önceden tanımlanmış olması gerekiyor. Biz de bunu kontrol 
         * ediyoruz. Test işlemlerinde herhangi bir web servise çağrıda 
         * bulunmadığımız için boş bir response objesi gönderiyoruz. 
         * Dolayısıyla diğer web servislerin çalışması bizi alakadar 
         * etmiyor.
         */
        if (defined('CodeCeption'))
        {
            // Boş bir response gönderilir geriye
            return new Response();
        }

        // Eğer bu bir geçrek istekte web servis çağrırılıyor.
        $response = new Response(
                call_user_func_array(
                    [
                        $this->connection($name),       // ilgili web servis 
                        $method                         // çağırılacak method 
                    ],      
                    $arguments                          // gönderilecek parametreler
                )
            );

        // Hata kontrolü ve hata varsa exception oluşturma işlemi
        if ($response->hasError()) 
        {
            throw new ServiceException(
                    $response->getErrorMessage(),       // servisten gelen hata mesajı
                    $response->getErrorCode()           // servisten gelen hata kodu
                );
        }
        return $response;
    }

}