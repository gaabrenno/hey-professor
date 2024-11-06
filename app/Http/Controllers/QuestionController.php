<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\{RedirectResponse, Request};

class QuestionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {

        $atributes = request()->validate([
            'question' => ['required'],
        ]);

        Question::query()->create($atributes);

        return to_route('dashboard');
    }
}
