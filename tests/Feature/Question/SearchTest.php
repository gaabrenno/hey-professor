<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to search a question by text', function () {
    $user           = User::factory()->create();
    $wrongQuestions = Question::factory()->create([
        'question' => 'How to create a test in PHPUnit?',
    ]);
    $questions = Question::factory()->create([
        'question' => 'How to create a test in Pest?',
    ]);
    actingAs($user);

    $response = get(route('dashboard', ['search' => 'Pest']));

    $response->assertDontSee('How to create a test in PHPUnit?');

    $response->assertSee('How to create a test in Pest?');
});
