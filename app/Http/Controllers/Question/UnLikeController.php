<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\{Question};
use Illuminate\Http\RedirectResponse;

class UnLikeController extends Controller
{
    public function __invoke(Question $questionId): RedirectResponse
    {
        user()->unlike($questionId);

        return back();
    }
}
