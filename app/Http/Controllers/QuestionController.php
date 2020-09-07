<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Question;
use App\Answer;

class QuestionController extends Controller
{
  protected function randomPlaceholder() {
    $placeholders = array(
      "How can anyone milk an almond?",
      "If vegans love plants so much, why do you eat them?",
      "Won't cows go extinct if we don't breed them?",
      "Isn't soy the worst for our environment?",
      "Have you been to my uncle's farm?",
      "Where do you get your protein?",
      "But bacon.... ?",
      "How could I possibly live without cheese?",
      "Why are you so extreme?",
      "Is Beyond meat healthier than beef?",
      "Is honey vegan?",
      "Can vegans still wear leather?",
      "Are oysters vegan?",
      "B12, checkmate, amirite?"
    );
    $random = array_rand($placeholders);
    return $placeholders[$random];
  }

  public function validateAnswer() {
    $question = Question::findOrFail(request('question_id'));
    return request()->validate([
        'answer' => ['required', 'min:5'],
        'question_id' => ['required']
    ]);
}

  protected function validateQuestion() {
    return request()->validate([
      'question' => ['required', 'min:5', 'regex:/^.*\?$/']],
      ['question.regex' => Config::get('constants.question_mark_missing')]
    );
  }

  public function index(Request $request) {
    // fetch questions and how many answers they each have
    $questionCollection = Question::withCount(['answers'])->get();
    $questions = $questionCollection->sortByDesc('created_at');
    $headerText = count($questions) > 0 ? Config::get('constants.questions_to_display') : Config::get('constants.no_questions_to_display');
    // fetch any flash data from successful question creation
    $flash = $request->session()->get('status');
    return view('questions.index', compact('questions', 'flash', 'headerText'));
  }

  public function create() {
    $placeholder = $this->randomPlaceholder();
    return view('questions.createQuestion', compact('placeholder'));
  }

  public function show(Request $request, Question $question) {
    $answers = $question->answers->sortBy('created_at');
    $labelText = count($answers) > 0 ? Config::get('constants.answers_submitted') : Config::get('constants.no_answers');
    // fetch any flash data from successful question creation
    $flash = $request->session()->get('status');
    return view ('questions.answers', compact('question', 'answers', 'labelText', 'flash'));
  }

  public function store(Request $request) {
    $validated = $this->validateQuestion();
    Question::create($validated);
    $request->session()->flash('status', Config::get('constants.question_saved'));
    return redirect(route('questions.index'));

  }

  public function answer(Request $request) {
    $validated = $this->validateAnswer();
    $newAnswer = Answer::create($validated);
    $request->session()->flash('status', Config::get('constants.answer_saved'));
    return redirect($newAnswer -> path());

  }
}
