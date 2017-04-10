<?php namespace Kernel\HTTP;

use Kernel\Connector;
use Debug;

/**
 * Response
 *
 * Response mesajı bu sınıf aracılığı ile oluşturulmaktadır.
 *
 * @author    Özgür Adem Işıklı           <ozgur@polisoft.com.tr>
 * @copyright Polisoft Yazılım               
 * @license   http://www.polisoft.com.tr
 * @since     Release 1.0.0
 */
class Response extends Connector {

    /**
     * Response structure 
     *
     * @var object
     */
    private $structure;

    /**
     * Class constructer 
     *
     * @return null
     */
    public function __construct()
    {
        parent::__construct();
        $this->structure = (object) [
            "error"    => false,
            "response" => (object) [
                "data" => [],
                "lockedFields" => []
            ]
        ];
    }

    /**
     * This method sets the data of the response
     *
     * @param  mixed        $response
     * @return self
     */
    public function data($response)
    {
        $this->structure->response->data = $response;
        return $this;
    }

    /**
     * This method gets the data 
     *
     * @return array
     */
    public function getData()
    {
        return $this->structure->response->data;
    }

    /**
     * This method sets the locked fields 
     *
     * @param  array        $fields 
     * @return null
     */
    public function setLockedFields($fields)
    {
        $this->structure->response->lockedFields = $fields;
    }

    /**
     * Setting errors 
     *
     * @param  string       $type
     * @param  array        $texts
     * @return self
     */
    public function setErrors($type, $texts)
    {
        $this->structure->error = (object) [
            "type"  => $type,
            "texts" => $texts
        ];
        return $this;
    }

    /**
     * Setting errors 
     *
     * @param  string       $type
     * @param  string       $texts
     * @return self
     */
    public function error($type, $text)
    {
        $this->structure->error = (object) [
            "type"  => $type,
            "texts" => [$text]
        ];
        return $this;
    }    

    /**
     * This method puts the json data to output
     * 
     * @return null
     */
    public function get()
    {
        if (getenv('environment') === 'development')
        {
            // Debug mesajları eklenir
            $this->structure->debug = Debug::get();
            // İstatistiki bilgiler eklenir
            $mtime = explode(" ", microtime()); 
            $finish = $mtime[1] + $mtime[0];
            $this->structure->stats = [
                'time' => number_format($finish - APP_START_TIME, 3),
                'memory' => $this->bytesToSize(memory_get_usage())
            ];
        }

        if (defined('CodeCeption'))
        {
            $this->structure->tests = Debug::getCodes();
        }

        echo json_encode($this->structure);
    }

    /**
     * This method converts to byte to string 
     *
     * @param   integer         $bytes
     * @param   integer         $precision
     * @return  String
     */
    private function bytesToSize($bytes, $precision = 2) 
    {
        $kilobyte = 1024;
        $megabyte = $kilobyte * 1024;
        $gigabyte = $megabyte * 1024;
        $terabyte = $gigabyte * 1024;

        if (($bytes >= 0) && ($bytes < $kilobyte)) {
            return $bytes . ' Byte';

        } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
            return round($bytes / $kilobyte, $precision) . ' KB';

        } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
            return round($bytes / $megabyte, $precision) . ' MB';

        } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
            return round($bytes / $gigabyte, $precision) . ' GB';

        } elseif ($bytes >= $terabyte) {
            return round($bytes / $terabyte, $precision) . ' TB';
        } else {
            return $bytes . ' Byte';
        }
    }
    
}