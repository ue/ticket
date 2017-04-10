<?php namespace Kernel\Loader;

use Illuminate\Database\Capsule\Manager as Capsule;
use DB, PDO;

class Database implements LoaderInterface {

    /**
     * This method is the trigger method that is called by 
     * the decorator class
     *
     * @return null
     */
    public function trigger()
    {
        $capsule = new Capsule; 
        $capsule->addConnection(array(
            'driver'    => 'mysql',
            'host'      => getenv('hostname'),
            'database'  => getenv('database'),
            'username'  => getenv('username'),
            'password'  => getenv('password'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'options'   => array(
                PDO::ATTR_PERSISTENT => true,
            )
        ));
        $capsule->bootEloquent();
        DB::setCapsule($capsule);   
    }
    
}