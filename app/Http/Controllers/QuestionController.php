<?php

namespace App\Http\Controllers;

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
      ['question.regex' => 'Questions must end with a question mark.']
    );
  }

  public function index(Request $request) {
    // fetch questions and how many answers they each have
    $questionCollection = Question::withCount(['answers'])->get();
    $questions = $questionCollection->sortByDesc('created_at');
    // fetch any flash data from successful question creation
    $flash = $request->session()->get('status');
    return view('questions.index', compact('questions', 'flash'));
  }

  public function create() {
    $placeholder = $this->randomPlaceholder();
    return view('questions.createQuestion', compact('placeholder'));
  }

  public function show(Request $request, Question $question) {
    $answers = $question->answers->sortBy('created_at');
    $labelText = count($answers) > 0 ? "The submitted answers are shown below. If you don't like them, post your own!" : "No answers have been posted yet, be the first!";
    // fetch any flash data from successful question creation
    $flash = $request->session()->get('status');
    return view ('questions.answers', compact('question', 'answers', 'labelText', 'flash'));
  }

  public function store(Request $request) {
    $validated = $this->validateQuestion();
    Question::create($validated);
    $request->session()->flash('status', 'Your question has been saved!');
    return redirect(route('questions.index'));

  }

  public function answer(Request $request) {
    $validated = $this->validateAnswer();
    $newAnswer = Answer::create($validated);
    $request->session()->flash('status', 'You answer has been saved!');
    return redirect($newAnswer -> path());

  }
}
