<?php

namespace App\Services;

use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;
use App\SocialAccount;

class SocialAccountService
{


    public static function createOrGetUser(ProviderUser $providerUser, $social)
    {
        $account = SocialAccount::whereProvider($social)
            ->whereProviderUserId($providerUser->getId())
            ->first();
      
        if ($account) {
            return $account->user;
        } else {
            $email = $providerUser->getEmail() ?  $providerUser->getEmail() : $providerUser->getNickname();
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $social
            ]);
            $user = User::whereEmail($email)->first();
            if (!$user) {
              if($social=="facebook"){
                $user = new User();
                $user->email = $email;
                $user->name = $providerUser->getName();
                $user->password = bcrypt('social');
                $user->avatar = "http://graph.facebook.com/".$providerUser->getId()."/picture?type=square";
                $user->role_id = 2;
                $user->publish = 1;

                $user->save();
              }
              else{
                $user = new User();
                $user->email = $email;
                $user->name = $providerUser->getName();
                $user->password = bcrypt('social');
                $user->avatar = $providerUser->avatar;
                $user->role_id = 2;
                $user->publish = 1;

                $user->save();
              }
            }

            $account->user()->associate($user);
            $account->save();
            return $user;
        }
    }
}