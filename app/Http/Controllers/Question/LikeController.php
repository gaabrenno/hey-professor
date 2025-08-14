<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\{Question};
use Illuminate\Http\RedirectResponse;

class LikeController extends Controller
{
    public function __invoke(Question $questionId): RedirectResponse
    {
        user()->like($questionId);

        return to_route('question.index')->withFragment('q-' . $questionId->id);
    }
}
