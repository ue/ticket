<?php namespace App\Controllers;

use App\Security\Roles\Member;
use App\Repositories\Category as Repository;
use Input, Auth;

class Category extends Member {

    /**
     * Yeni bir kategori oluşturur 
     *
     * @return null
     */
    public function create()
    {
        $repository = new Repository();
        $this->response->data(
            $repository->create(
                Input::get('title')
            )
        );
    }

    /**
     * Root Id'ye göre kategoriyi geriye gönderir
     *
     * @return null
     */
    public function getByRoot()
    {
        $repository = new Repository();
        $this->response->data(
            $repository->getByRoot(Input::get('rootId'))
        );
    }

    /**
     * Seçili kategoriyi günceller
     *
     * @return null
     */
    public function update()
    {
        $repository = new Repository();
        $this->response->data(
            $repository->update(
                Input::get('id'),
                Input::get('title')
            )
        );
    }
    
    
}