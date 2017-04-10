<?php namespace App\Security\Bridges;

use Kernel\Security\Bridge;
use App\Repositories\Token as TokenRepository;
use Kernel\Exceptions\AuthException;
use Input, Exception, Auth, CI;

/**
 * Language
 *
 * Kullanıcının dil seçimine göre gerekli dil dosyalarını 
 * yükler.
 *
 * @author    Özgür Adem Işıklı           <ozgur@polisoft.com.tr>
 * @copyright Polisoft Yazılım               
 * @license   http://www.polisoft.com.tr
 * @since     Release 1.0.0
 */
class Language extends Bridge {

    /**
     * This methos sets the language
     *
     * @return boolean
     */
    public function attempt()
    {
        $language = Input::language();
        define('LANG_SHORT', $language);
        switch (Input::language()) {
            case 'tr':
                CI::config()->set_item('language', 'turkish');
                CI::loadLang('items', 'turkish');
                define('LANG_LONG', 'turkish');
                break;
            case 'en':
                CI::config()->set_item('language', 'english');
                CI::loadLang('items', 'english');
                define('LANG_LONG', 'english');
                break;            
            default:
                CI::config()->set_item('language', 'turkish');
                CI::loadLang('items', 'turkish');
                define('LANG_LONG', 'turkish');
                break;
        }

        return true;
    }   

}