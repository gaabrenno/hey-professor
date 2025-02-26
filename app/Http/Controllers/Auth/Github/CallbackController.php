<?php

namespace App\Http\Controllers\Auth\Github;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class CallbackController extends Controller
{
    public function __invoke(Request $request)
    {
        $gitHubUser = Socialite::driver('github')->user();

        $user = User::query()
        ->updateOrCreate(
            ['email' => $gitHubUser->getEmail(), 'nickname' => $gitHubUser->getNickname()],
            [
                'name'              => $gitHubUser->getName(),
                'email'             => $gitHubUser->getEmail(),
                'password'          => bcrypt($gitHubUser->getId()),
                'email_verified_at' => now(),
            ]
        );
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
