<?php

namespace App\Http\Controllers;

use Illuminate\Http\{RedirectResponse, Request};

class QuestionController extends Controller
{
    public function store(Request $request): RedirectResponse
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

        return to_route('dashboard');
    }
}
