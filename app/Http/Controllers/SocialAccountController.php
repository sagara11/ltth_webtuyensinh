<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\SocialAccountService;
use Socialite;
use Auth;

class SocialAccountController extends Controller
{

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        return $user->name;
        // Auth::login($user);

        // return redirect()->to('/');
    }

}

