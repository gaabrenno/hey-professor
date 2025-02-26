<?php

use App\Models\{Question, User};
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use function Pest\Laravel\{actingAs, get};

// it('should list questions', function () {

//     $user      = User::factory()->create();
//     $questions = Question::factory()->count(5)->create();

//     actingAs($user);

//     $response = get(route('dashboard'));

//     /** @var Question $q  */
//     foreach ($questions as $q) {
//         $response->assertSee($q->question);
//     }
// });

it('should paginate the resoult', function () {

    $user      = User::factory()->create();
    $questions = Question::factory()->count(15)->create();

    actingAs($user);

    get(route('dashboard'))
        ->assertViewHas('questions', function ($value) {
            return $value instanceof LengthAwarePaginator;
        });

});

it('shold order by like and unlike, most liked question shold be at th top, most unliked questions shold be in th bottom', function () {

    $user = User::factory()->create();

    $questions      = Question::factory()->count(5)->create();
    $likeQuestion   = Question::find(3);
    $unlikeQuestion = Question::find(1);
    $user->like($likeQuestion);
    $unlikeUser = User::factory()->create();
    $unlikeUser->unlike($unlikeQuestion);

    actingAs($user);
    get(route('dashboard'))
        ->assertViewHas('questions', function ($questions) {
            expect($questions)
                ->first()->id->toBe(3)
                ->and($questions)
                ->last()->id->toBe(1);

            return true;
        });
});
