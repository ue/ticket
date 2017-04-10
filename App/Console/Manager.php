<?php namespace App\Console;

use Symfony\Component\Console\Application;

class Manager {

    /**
     * Console Object 
     *
     * @var Symfony\Component\Console\Application
     */
    private $console;

    /**
     * Class constructer 
     *
     * @param  string       $root
     * @return null
     */
    public function __construct($root)
    {
        $this->loadEnvironments($root);
        $this->console = new Application('Ticket Project Developer Console', '1.0');
        
        $this->console->add(new Migration\Create);
        $this->console->add(new Migration\Run);
    }

    /**
     * This method runs the console 
     *
     * @return null
     */
    public function run()
    {
        $this->console->run();         
    }   

    /**
     * This method loads the environment options 
     *
     * @param  string       $root 
     * @return null
     */
    private function loadEnvironments($root)
    {
        // Genel yapılandırma
        $configurations = json_decode(file_get_contents($root.'/.env.config.json'));
        foreach ($configurations as $key => $value) 
        {
            define('sys_'.$key, $value);
            putenv("$key=$value");
        }
    }

}