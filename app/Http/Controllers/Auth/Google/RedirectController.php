<?php

namespace App\Http\Controllers\Auth\Google;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class RedirectController extends Controller
{
    public function __invoke(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }
}
