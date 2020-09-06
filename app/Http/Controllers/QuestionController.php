<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index() {
        return view('questions.index');
    }

    public function create() {
        return view('questions.createQuestion');
    }

    public function show($question) {
        return view ('questions.answers');
    }
}
