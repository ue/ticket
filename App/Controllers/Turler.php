<?php namespace App\Controllers;

use App\Security\Roles\Anonymous;
use Kernel\Exceptions\UserException;
use App\Models\User;
use App\Models\Category;
use App\Models\Question;
use Input, Exception;

class Turler extends Anonymous {

    public function create()
    {
        $Category = new Category();
        $Category->title = Input::get('title');
        $Category->save();
        $this->response->data($Category);
    }

    public function get()
    {
        $this->response->data(Category::where('root_id', '=', Input::get('rootId'))->get());
    }

    public function update()
    {
        try {
            $Category = Category::findOrFail(Input::get('id'));
            $Category->title = Input::get('title');
            $Category->save();
            $this->response->data($Category);            
        } catch (Exception $e) {
            throw new UserException('Kayıt bulunamadı');
        }
    }
    
     public function delete()
     {
         try {
              $Category = Category:: find(Input::get('id'));
              $Category->delete();
             
         } catch (Exception $e) {
             throw new Exception('Silinecek Kayıt Bulunamadı');
                                       
         }



     }




}