<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to list all question created by me', function () {
    $anotherUser      = User::factory()->create();
    $anotherquestions = Question::factory()->for($anotherUser, 'createdBy')->count(10)->create();

    $user      = User::factory()->create();
    $questions = Question::factory()->for($user, 'createdBy')->count(10)->create();

    actingAs($user);
    $respose = get(route('question.index'));

    /** @var Question $q */
    foreach ($questions as $q) {
        $respose->assertSee($q->question);
    }

    /** @var Question $q */
    foreach ($anotherquestions as $q) {
        $respose->assertDontSee($q->question);
    }

});
