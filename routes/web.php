<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/questions', 'QuestionController@index')->name('questions.index');

Route::get('/questions/create', 'QuestionController@create')->name('questions.create');

Route::get('/questions/{question}', 'QuestionController@show')->name('questions.show');

Route::post('/questions', 'QuestionController@store')->name('questions.store');

Route::post('/questions/{question}/answers', 'QuestionController@answer')->name('answers.store');
