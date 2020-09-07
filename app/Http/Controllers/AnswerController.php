<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;

class AnswerController extends Controller
{
    public function validateAnswer() {
        $question = Question::findOrFail(request('question_id'));
        return request()->validate([
            'answer' => ['required', 'min:5'],
            'question_id' => ['required']
        ]);
    }

    public function store() {
        $validated = $this->validateAnswer();
        $newAnswer = Answer::create($validated);
        return redirect($newAnswer -> path());

    }
}
