<?php

namespace App\Http\Controllers\Auth\Google;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class CallbackController extends Controller
{
    public function __invoke(Request $request)
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::query()
        ->updateOrCreate(
            ['email' => $googleUser->getEmail(), 'nickname' => $googleUser->getNickname()],
            [
                'name'              => $googleUser->getName(),
                'email'             => $googleUser->getEmail(),
                'password'          => bcrypt($googleUser->getId()),
                'email_verified_at' => now(),
            ]
        );
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
