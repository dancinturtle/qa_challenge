<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  protected $fillable = [
    'question'
  ];



  public function path() {
    return route('questions.show', $this);
  }

  public function answers() {
    return $this->hasMany(Answer::class);
  }
}
