<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  protected $fillable = [
    'answer',
    'question_id'
  ];

  public function path() {
    return route('questions.show', $this->question);
  }

  public function question() {
    return $this->belongsTo(Question::class);
  }
}

