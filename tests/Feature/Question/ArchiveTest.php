<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertSoftDeleted, patch};

it('should be able to archive a question', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create(['draft' => true, 'created_by' => $user]);
    actingAs($user);

    patch(route('question.archive', $question))->assertRedirect();

    assertSoftDeleted('questions', ['id' => $question->id]);

    expect($question)
        ->refresh()
        ->deleted_at->not->toBeNull();
});

it('shold make sure only the person who has created the question can archive the question', function () {

    $user = User::factory()->create();
    actingAs($user);
    $question = Question::factory()->create(['draft' => true]);

    $anotherUser = User::factory()->create();
    actingAs($anotherUser);

    patch(route('question.archive', $question))->assertForbidden();

    $question->refresh();
    expect($question)->draft->toBeTrue();

});
