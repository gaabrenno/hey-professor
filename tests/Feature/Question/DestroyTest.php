<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseMissing, delete};

it('should be able to destroy a question', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create(['draft' => true, 'created_by' => $user]);
    actingAs($user);

    delete(route('question.destroy', $question))->assertRedirect();

    assertDatabaseMissing('questions', ['id' => $question->id]);

});

it('shold make sure only the person who has created the question can destroy the question', function () {

    $user = User::factory()->create();
    actingAs($user);
    $question = Question::factory()->create(['draft' => true]);

    $anotherUser = User::factory()->create();
    actingAs($anotherUser);

    delete(route('question.destroy', $question))->assertForbidden();

    $question->refresh();
    expect($question)->draft->toBeTrue();

});
