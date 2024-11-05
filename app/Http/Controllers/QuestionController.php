<?php

namespace App\Http\Controllers;

use Illuminate\Http\{RedirectResponse, Request};

class QuestionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        return to_route('dashboard');
    }
}
