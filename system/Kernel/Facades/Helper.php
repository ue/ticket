<?php namespace Kernel\Facades;

class Helper {

    /**
     * This method mask the phone 
     *
     * @param  string       $phone
     * @return string
     */
    public function maskPhone($phone)
    {
        // Eğer telefon verisi gönderilmemişse
        if ($phone === false)
        {
            return '';
        }

        // Eğer telefon verisi şu formattaysa: (554) 222-1212
        if (strlen($phone) === 14) 
        {
            return '0'.str_replace(['(', ')', '+', '-', ' '], '', $phone);
        }

        // Telefon verisi şu formattaysa 5551112233
        if (strlen($phone) === 10 && is_numeric($phone))
        {  
            return '0'.$phone;
        }

        // Tüm bunlar dışında bir formatsa
        log_message('error', "Uyun olmayan telefon formatı: $phone");
        return '';
    }
    
}