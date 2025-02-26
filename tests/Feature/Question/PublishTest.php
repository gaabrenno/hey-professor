<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, put};

it('should be able to publish a question', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create(['draft' => true, 'created_by' => $user]);
    actingAs($user);

    put(route('question.publish', $question))->assertRedirect();

    $question->refresh();
    expect($question->draft)->toBeFalse();

});

it('shold make sure only the person who has created the question can publish the question', function () {

    $user = User::factory()->create();
    actingAs($user);
    $question = Question::factory()->create(['draft' => true]);

    $anotherUser = User::factory()->create();
    actingAs($anotherUser);

    put(route('question.publish', $question))->assertForbidden();

    $question->refresh();
    expect($question)->draft->toBeTrue();

});
