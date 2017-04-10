<?php namespace App\Console;

use Symfony\Component\Console\Command\Command As SymfonyCommand;
use Illuminate\Database\Capsule\Manager as Capsule;
use PDO;

class Command extends SymfonyCommand {

    /**
     * Database object 
     *
     * @var Illuminate\Database\Capsule\Manager
     */
    protected $database;

    /**
     * Class constructer 
     *
     * @return null
     */
    public function __construct()
    {
        parent::__construct();
        $this->loadDatabase();
    }

    /**
     * This method loads the database
     *
     * @return null
     */
    public function loadDatabase()
    {
        $this->capsule = new Capsule; 
        $this->capsule->addConnection(array(
            'driver'    => 'mysql',
            'host'      => sys_hostname,
            'database'  => sys_database,
            'username'  => sys_username,
            'password'  => sys_password,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'options'   => array(
                PDO::ATTR_PERSISTENT => true,
            )
        ));
        $this->capsule->bootEloquent();
    } 

}