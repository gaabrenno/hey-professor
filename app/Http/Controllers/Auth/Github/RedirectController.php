<?php

namespace App\Http\Controllers\Auth\Github;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class RedirectController extends Controller
{
    public function __invoke(Request $request)
    {
        return Socialite::driver('github')->redirect();
    }
}
