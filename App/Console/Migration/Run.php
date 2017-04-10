<?php namespace App\Console\Migration;

use App\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Models\Migration;
use dir\Dir;
use Exception;

class Run extends Command {

    /**
     * Command configuration
     *
     * @return null
     */
    protected function configure()
    {
        $this->setName('migration:run')
             ->setDescription('Veritabanını günceller');
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
        // Dosyalar aranır
        $files = Dir::scan(ROOT.'migrations/', ['include' => '*.sql']);
        $executed = 0;

        foreach ($files as $key => $file) 
        {
            try {
                Migration::where('file', '=', $file)->firstOrFail();
            } catch (Exception $e) {
                try {
                    $this->capsule
                         ->getDatabaseManager()
                         ->connection()
                         ->select(file_get_contents($file));
                } catch (Exception $e) {
                    
                }
                $migration = new Migration;
                $migration->file = $file;
                $migration->executed_at = date('Y-m-d H:i:s');
                $migration->save();
                $executed++;                
            }
        }

        $output->writeln("<info>Tüm SQL dosyaları çalıştırıldı: $executed</info>");    
    }

}