<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class QuestionController extends Controller
{
  protected function validateQuestion() {
    return request()->validate([
      'question' => ['required', 'min:5', 'regex:/^.*\?$/']],
      ['question.regex' => 'Questions must end with a question mark']
    );
  }

  public function index() {
    $questionCollection = Question::withCount(['answers'])->get();
    $questions = $questionCollection->sortByDesc('created_at');
    return view('questions.index', compact('questions'));
  }

  public function create() {
    return view('questions.createQuestion');
  }

  public function show(Question $question) {
    $answers = $question->answers->sortBy('created_at');
    $labelText = count($answers) > 0 ? "Don't like these answers? Post your own!" : "No answers have been posted yet, be the first!";
    return view ('questions.answers', compact('question', 'answers', 'labelText'));
  }

  public function store() {
    $validated = $this->validateQuestion();
    Question::create($validated);
    return redirect(route('questions.index'));

  }
}
