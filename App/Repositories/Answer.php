<?php namespace App\Repositories;

use Kernel\Exceptions\UserException;
use App\Models\Answer as Model;

class Answer {
    
    public function create($content, $question_id, $user_id)
    {
        $answer = new Model();
        $answer->content = $content;
        $answer->question_id = $question_id;
        $answer->user_id = $user_id;
        $answer->save();
        return $answer;
    }

    public function getById($question_id)
    {
       return Model::where('question_id','=',$question_id)
                   ->get();
    }

    public function update($id, $closed_at)
    {
        try {
            $answer = $this->get($id);
            $answer->closed_at = $closed_at;
            $answer->save();
            return $answer;
        } catch (Exception $e) {
            throw new UserException('Kayıt bulunamadı');
        }
    }

}