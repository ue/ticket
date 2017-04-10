<?php namespace Kernel;

/**
 * Connector
 *
 * Bu sınıf CodeIgniter haricinde kalan sınıfların CodeIgniter
 * instance'ına ulaşması için geliştirilmeiştir. Böylece ekstra 
 * kod yazmadan CodeIgniter instance'ına $this->CI değişkeni ile 
 * ulaşılabilir.
 *
 * @author    Özgür Adem Işıklı           <ozgur@polisoft.com.tr>
 * @copyright Polisoft Yazılım               
 * @license   http://www.polisoft.com.tr
 * @since     Release 1.0.0
 */
class Connector {

    /**
     * CodeIgniter variable 
     *
     * @param  CodeIgniter
     */
    protected $CI;

    /**
     * Class constructer
     *
     * @return null
     */
    public function __construct()
    {
        $this->CI =& get_instance();        
    }   

}