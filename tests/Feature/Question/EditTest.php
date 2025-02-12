<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, get, put};

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

it('should update the question in the database', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);
    actingAs($user);

    put(route('question.update', $question), ['question' => 'Updated Question?'])->assertRedirect();

    $question->refresh();
    expect($question)->question->toBe('Updated Question?');
});

it('should make sure tht only question with status DRAFT can be updated', function () {
    $user             = User::factory()->create();
    $questionNotDraft = Question::factory()->for($user, 'createdBy')->create(['draft' => false]);
    $questioDraft     = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user);

    put(route('question.update', $questionNotDraft))->assertForbidden();
    put(route('question.update', $questioDraft), ['question' => 'New Question'])->assertRedirect();
});

it('shold make sure only the person who has created the question can update the question', function () {

    $user = User::factory()->create();
    actingAs($user);
    $question = Question::factory()->create(['draft' => true]);

    $anotherUser = User::factory()->create();
    actingAs($anotherUser);

    put(route('question.update', $question), ['question' => 'New Question'])->assertForbidden();

    $question->refresh();
    expect($question)->draft->toBeTrue();
});

it('should not be able to update a new question bigger than 255 chacters', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);
    actingAs($user);

    $request = put(route('question.update', $question), [
        'question' => str_repeat('#', 256) . '?',
    ]);

    $request->assertRedirect();
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', [
        'question' => str_repeat('#', 256) . '?',
    ]);
});

it('shold check if ends with question mark?', function () {

    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);
    actingAs($user);

    $request = put(route('question.update', $question), [
        'question' => str_repeat('#', 10),
    ]);

    $request->assertSessionHasErrors(['question' => 'Are you sure it is a question? It should end with a question mark in the end.']);
    assertDatabaseHas('questions', [
        'question' => $question->question,
    ]);

});

it('should have at least 10 characters', function () {

    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);
    actingAs($user);

    $request = put(route('question.update', $question), [
        'question' => str_repeat('#', 8) . '?',
    ]);

    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
    assertDatabaseHas('questions', [
        'question' => $question->question,
    ]);
});
