<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('should be able to create a new question bigger than 255 chacters', function () {
    //Arrange::preparar
    $user = User::factory()->create();
    actingAs($user);

    //Act::agir
    $request = post(route('questions.store'), [
        'question' => str_repeat('#', 256) . '?',
    ]);

    //Assert::verificar
    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', [
        'question' => str_repeat('#', 256) . '?',
    ]);
});

it('shold check if ends with question mark?', function () {

    //Arrange::preparar
    $user = User::factory()->create();
    actingAs($user);

    //Act::agir
    $request = post(route('questions.store'), [
        'question' => str_repeat('#', 10),
    ]);

    //Assert::verificar
    $request->assertSessionHasErrors(['question' => 'Are you sure it is a question? It should end with a question mark in the end.']);
    assertDatabaseCount('questions', 0);

});

it('should have at least 10 characters', function () {

    //Arrange::preparar
    $user = User::factory()->create();
    actingAs($user);

    //Act::agir
    $request = post(route('questions.store'), [
        'question' => str_repeat('#', 8) . '?',
    ]);

    //Assert::verificar
    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
    assertDatabaseCount('questions', 0);
});
