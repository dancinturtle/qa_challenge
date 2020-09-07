<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

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

  protected function validateQuestion() {
    return request()->validate([
      'question' => ['required', 'min:5', 'regex:/^.*\?$/']],
      ['question.regex' => 'Questions must end with a question mark.']
    );
  }

  public function index() {
    // fetch questions and how many answers they each have
    $questionCollection = Question::withCount(['answers'])->get();
    $questions = $questionCollection->sortByDesc('created_at');
    return view('questions.index', compact('questions'));
  }

  public function create() {
    $placeholder = $this->randomPlaceholder();
    return view('questions.createQuestion', compact('placeholder'));
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
