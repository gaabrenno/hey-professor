<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view(
            'dashboard',
            [
                'questions' => Question::select('questions.*')
                    ->leftJoin('votes', 'votes.question_id', 'questions.id')
                    ->selectRaw('COALESCE(SUM(votes.like), 0) AS votes_sum_like, COALESCE(SUM(votes.unlike), 0) AS votes_sum_unlike')
                    ->groupBy('questions.id')
                    ->orderByDesc('votes_sum_like')
                    ->orderBy('votes_sum_unlike')
                    ->paginate(5),

            ]
        );
    }
}
