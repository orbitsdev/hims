<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleCallbackController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callBack(){
        $google_user = Socialite::driver('google')->user();

        $usedAsCredentials = User::where('email', $google_user->email)
                                  ->where('provider', 'CREDENTIALS')
                                  ->exists();

        if ($usedAsCredentials) {
            return redirect()->route('login')->withErrors([
                'email' => 'This email is already associated with a non-Google account. Please use your credentials to log in.'
            ]);
        }


        $user = User::updateOrCreate([
            'email' => $google_user->email,
        ], [
            'name' => $google_user->name,
            'provider' => 'GOOGLE',
            'provider_id' => $google_user->id,
            'email_verified_at' => now(),
        ]);


        Auth::login($user);

        return redirect('/');
    }
}
