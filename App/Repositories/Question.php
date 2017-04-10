<?php namespace App\Repositories;

use App\Models\Question as QuestionModel;


class Question {

    public function create($con , $id)
    {
    	$sayi=12;
        $question = new QuestionModel();
        $question->categorie_id = $id;
        $question->contents = $con;
        $question->save();
        return $question;        
    }

    public function get()
    {
    	return QuestionModel::all();
    }
}