<?php namespace Kernel\Middleware;

use Kernel\Exceptions\ArgumentException;
use Kernel\Connector;
use CI;

/**
 * Manager
 *
 * Bu sınıf validasyon işlemlerini otomatik olarak yöneten 
 * bir sınıftır. Tek yapılması gereken Middleware katmanı altında
 * tanımlanan sınıfların bu sınıf üzerinden genişletilmesi ve ilgili 
 * validasyon kurallarının sınıf içerisindeki "zorunlu" metotta 
 * tanıtılmasıdır.  
 *
 * @author    Özgür Adem Işıklı           <ozgur@polisoft.com.tr>
 * @copyright Polisoft Yazılım               
 * @license   http://www.polisoft.com.tr
 * @since     Release 1.0.0
 * @see       App\Middleware\Auth\Login
 */
abstract class Middleware extends Connector {

    /**
     * This method gets validation rules as an array
     *
     * @return array
     */
    abstract public function getRules();

    /**
     * This method implements type hinting on fields that were 
     * sent by the user 
     *
     * @return null
     */
    protected function typeHinting()
    {
        // nothing
    }

    /**
     * This method gets the field map
     *
     * Eğer bu alan, kullanıcı tarafından tanımlanan zorunlu 
     * alanlar kontrolü içindir. Örneğin sistem tarafından adres 
     * alanı zorunlu olarak işaretlenmişse, bizim bunu kontrol etmemiz 
     * gerekmektedir. Ancak hangi alanın, hangi isimle zorunlu olarak 
     * işaratlendiğimizi bilmek zorundayız. Bu nedenle de alan 
     * haritalarımız mevcuttur. Bu haritalarımızı kullarak, servis üzerinden 
     * zorunlu alan karşılaştırması yaparız. Bu değer, hangi Middleware 
     * sınıfı için hangi haritanın kullanılacağını belirtmektedir. Herhangi 
     * bir değer seçilmezse, herhangi bir harita kullanılmaz.
     *
     * @return string
     */
    protected function getFieldMap()
    {
        return false;
    }

    /**
     * This method runs the validation parameters 
     *
     * @return null
     */
    public function run()
    {
        $this->setRules();
        $this->runValidation();
        $this->typeHinting();
    }

    /**
     * This method runs the validation rule 
     *
     * @return null
     */
    private function runValidation()
    {
        if (!$this->CI->form_validation->run())
        {
            throw new ArgumentException('Eksik bilgi gönderdiniz.');
        }
    }

    /**
     * This method sets all rules 
     *
     * @return null
     */
    private function setRules()
    {
        // Field map kontrolü yapılıyor
        $map = new FieldMap($this->getFieldMap());

        // Sabit kurallar ekleniyor
        $rules = $this->getRules();
        foreach ($rules as $key => $rules) 
        {
            $this->CI->form_validation->set_rules(
                $key,
                CI::lang("field_$key"),
                $map->addRule($key, $rules)
            );
        }
        
        // Standart tanımlama içinde bulunmayan, ama zorunlu olarak belirtilen 
        // alanlar için required kuralı oluşturulur.
        foreach ($map->getNetFields() as $key => $name)
        {
            $this->CI->form_validation->set_rules($name, CI::lang("field_$name"), 'required');
        }
    }

}
