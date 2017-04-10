<?php namespace App\Console\Migration;

use App\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Create extends Command {

    /**
     * Command configuration
     *
     * @return null
     */
    protected function configure()
    {
        $this->setName('migration:create')
             ->setDescription('Yeni migration dosyası oluşturur.');
    }

    /**
     * Execution
     *
     * @param  InputInterface       $input 
     * @param  OutputInterface      $output
     * @return null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {    
        // Dizin ve dosya yolları belirlenir
        $folder = ROOT.'migrations/'.date('Ym').'/';
        $file = $folder.date('dHis').'.sql';

        // Klasör yoksa oluşturulur
        if (file_exists($folder) === false)
        {   
            mkdir($folder, 0777);
        }

        // Dosya oluşturulur
        file_put_contents($file, '# Your SQL Code must be to here!');

        $output->writeln("<info>SQL dosyası oluşturuldu: ".date('dHis').'.sql'."</info>");
    }

}