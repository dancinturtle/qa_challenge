<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Config;

class QuestionTest extends TestCase
{
	use WithFaker, RefreshDatabase;
	protected function addValidQuestions($num) {
		for($i=1; $i<=$num; $i++){
			$attributes = [
				'question' => 'Quinoa question ' . $i . '?'
			];
			$this->post(route('questions.store'), $attributes);
			$this->assertDatabaseHas('questions', $attributes);
		}
	}

	protected function addValidAnswers($question_id, $num){
		for($i=1; $i<=$num; $i++){
			$attributes=[
				'answer' => 'Quinoa tiny hero ' . $i,
				'question_id' => $question_id
			];
			sleep(1);
			$this->post(route('answers.store', $question_id), $attributes);
			$this->assertDatabaseHas('answers', $attributes);
		}
	}

	public function testUserCanCreateAndViewQuestions() {
		$this->withoutExceptionHandling();
		$attributes = [
				'question' => 'Where do you get your protein?'
		];
		$this->post(route('questions.store'), $attributes)->assertRedirect(route('questions.index'));
		$this->assertDatabaseHas('questions', $attributes);
		$flash = session('status');
		$this->assertEquals(Config::get('constants.question_saved'), $flash);
		$this->get(route('questions.index'))->assertSee($attributes['question']);
	}

	public function testUserWillViewQuestionsInOrder() {
		// $attributes1 = [
		// 	'question' => 'Where do you get your protein?'
		// ];
		// $attributes2 = [
		// 	'question' => 'Do plants feel pain?'
		// ];
		$this->addValidQuestions(2);
		// $this->post(route('questions.store'), $attributes1);
		// $this->assertDatabaseHas('questions', $attributes1);
		// sleep(1);
		// $this->post(route('questions.store'), $attributes2);
		// $this->assertDatabaseHas('questions', $attributes2);
		// $ordered = array($attributes2['question'], $attributes1['question']);
		$ordered = array('Quinoa question 1?', 'Quinoa question 2?');
		$this->get(route('questions.index'))->assertSeeInOrder($ordered);
	}

	public function testUserWillSeeNoQuestions() {
		$this->get(route('questions.index'))->assertSeeText('We have no questions yet!')->assertDontSee('Date asked');
	}

	public function testUserWillViewCreateQuestionForm() {
		$this->get(route('questions.create'))->assertSeeText('Ask your question')->assertSeeText('5 character minimum and end with a question mark please.');
	}

	public function testQuestionIsRequired() {
		$attributes = [
			'question' => ''
		];
		$this->post(route('questions.store'), $attributes)->assertStatus(302);
		$this->assertDatabaseMissing('questions', $attributes);
		$this->get(route('questions.create'))->assertSeeText(Config::get('constants.question_required'));
	}

	public function testQuestionMinimum() {
		$attributes = [
			'question' => 'Hi?'
		];
		$this->post(route('questions.store'), $attributes)->assertStatus(302);
		$this->assertDatabaseMissing('questions', $attributes);
		$this->get(route('questions.create'))->assertSeeText(Config::get('constants.question_minimum'));
	}

	public function testQuestionMustHaveQuestionMark() {
		$attributes = [
				'question' => 'Where do you get your protein'
		];
		$this->post(route('questions.store'), $attributes)->assertStatus(302);
		$this->assertDatabaseMissing('questions', $attributes);
		$this->get(route('questions.create'))->assertSee(Config::get('constants.question_mark_missing'));
	}

	public function testUnfoundQuestion() {
		$this->get(route('questions.show', 1))->assertStatus(404);
	}

	public function testUserCanCreateAndViewAnswers() {
		$this->withoutExceptionHandling();
		$this->addValidQuestions(4);
		$attributes = [
			'answer' => 'Quinoa tiny hero',
			'question_id' => 1
		];
		$this->post(route('answers.store', 1), $attributes);
		$this->assertDatabaseHas('answers', $attributes);
		$flash = session('status');
		$this->assertEquals(Config::get('constants.answer_saved'), $flash);
		$this->get(route('questions.show', 1))->assertSee($attributes['answer']);
		$this->get(route('questions.show', 2))->assertDontSee($attributes['answer'])->assertSee('No answers have been posted yet, be the first!');
	}

	public function testAnswersShouldBeInOrderFromOldToNew() {
		$this->addValidQuestions(1);
		$this->addValidAnswers(1, 3);
		$orderedAnswers = array('Quinoa tiny hero 1', 'Quinoa tiny hero 2', 'Quinoa tiny hero 3');
		$this->get(route('questions.show', 1))->assertSeeInOrder($orderedAnswers);
	}

	public function testAnswerIsRequired() {
		$this->addValidQuestions(1);
		$attributes = [
			'answer' => '',
			'question_id' => 1
		];
		$this->post(route('answers.store', 1), $attributes)->assertStatus(302);
		$this->assertDatabaseMissing('answers', $attributes);
		$this->get(route('questions.show', 1))->assertSeeText(Config::get('constants.answer_required'));
	}

	public function testAnswerMinimum() {
		$this->addValidQuestions(1);
		$attributes = [
			'answer' => 'No',
			'question_id' => 1
		];
		$this->post(route('answers.store', 1), $attributes)->assertStatus(302);
		$this->assertDatabaseMissing('answers', $attributes);
		$this->get(route('questions.show', 1))->assertSeeText(Config::get('constants.answer_minimum'));
	}




}
