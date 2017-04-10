<?php namespace Kernel;

/**
 * Facade 
 *
 * Facade türünden sınıflar tanımlamak için kullanılır.
 *
 * @author    Özgür Adem Işıklı           <ozgur@polisoft.com.tr>
 * @copyright Polisoft Yazılım               
 * @license   http://www.polisoft.com.tr
 * @since     Release 1.0.0
 * @see       system/applications/facades
 */
class Facade {

    /**
     * Instances for original classes
     *
     * @var array
     */
    private static $instances = array();

    /**
     * Call static magic method
     *
     * @param  string       $method
     * @param  arrray       $arguments
     */
    public static function __callStatic($method, $arguments)
    {
        $connector = static::getFacadeAccessor();
        if (!isset(self::$instances[$connector])) {
            self::$instances[$connector] = new $connector;
        }
        return call_user_func_array(array(self::$instances[$connector], $method), $arguments);
    }

}