<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\{RedirectResponse};

class QuestionController extends Controller
{
    public function index(): View
    {
        return view('question.index', [
            'questions' => user()->questions,
        ]);
    }

    public function store(): RedirectResponse
    {

        $atributes = request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $atribute, mixed $value, callable $fail) {
                    if ($value[strlen($value) - 1] !== '?') {
                        $fail('Are you sure it is a question? It should end with a question mark in the end.');
                    }
                },
            ],
        ]);

        user()->questions()
            ->create([
                'question' => $atributes['question'],
                'draft'    => true,
            ]);

        return back();
    }
}
