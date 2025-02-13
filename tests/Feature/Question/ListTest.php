<?php

use App\Models\{Question, User};
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use function Pest\Laravel\{actingAs, get};

it('should list questions', function () {

    $user      = User::factory()->create();
    $questions = Question::factory()->count(5)->create();

    actingAs($user);

    $response = get(route('dashboard'));

    /** @var Question $q  */
    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }
});

it('should paginate the resoult', function () {

    $user      = User::factory()->create();
    $questions = Question::factory()->count(15)->create();

    actingAs($user);

    get(route('dashboard'))
        ->assertViewHas('questions', function ($value) {
            return $value instanceof LengthAwarePaginator;
        });

});
