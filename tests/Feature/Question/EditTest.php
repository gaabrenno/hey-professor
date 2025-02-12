<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('shold be able to open a question to edit', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);
    actingAs($user);

    get(route('question.edit', $question))->assertSuccessful();
});

it('should return a view', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);
    actingAs($user);

    get(route('question.edit', $question))->assertViewIs('question.edit');
});

it('should make sure tht only question with status DRAFT can be edited', function () {
    $user             = User::factory()->create();
    $questionNotDraft = Question::factory()->for($user, 'createdBy')->create(['draft' => false]);
    $questioDraft     = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user);

    get(route('question.edit', $questionNotDraft))->assertForbidden();
    get(route('question.edit', $questioDraft))->assertSuccessful();
});

it('shold make sure only the person who has created the question can edit the question', function () {

    $user = User::factory()->create();
    actingAs($user);
    $question = Question::factory()->create(['draft' => true]);

    $anotherUser = User::factory()->create();
    actingAs($anotherUser);

    get(route('question.edit', $question))->assertForbidden();

    $question->refresh();
    expect($question)->draft->toBeTrue();
});
