<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testUserCanCreateQuestion() {
        $this->withoutExceptionHandling();
        $attributes = [
            'question' => $this->faker->sentence
        ];
        $this->post('/questions', $attributes);
        $this->assertDatabaseHas('questions', $attributes);
    }
}
