<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function providerCallback(string $provider): RedirectResponse
    {
        try {
            $social_user = Socialite::driver($provider)->user();
            // First Find Social Account
            $account = SocialAccount::where([
                'provider_name' => $provider,
                'provider_id' => $social_user->getId()
            ])->first();

            // If Social Account Exist then Find User and Login
            if ($account) {
                auth()->login($account->user);
                return redirect()->route('home');
            }

            // Find User
            $user = User::where([
                'email' => $social_user->getEmail()
            ])->first();

            // If User not get then create new user
            if (!$user) {
                $user = User::create([
                    'email' => $social_user->getEmail(),
                    'name' => $social_user->getName(),
                    'password' => password_hash($social_user->getName(), PASSWORD_DEFAULT)]);
            }

            // Create Social Accounts
            $user->socialAccounts()->create([
                'provider_id' => $social_user->getId(),
                'provider_name' => $provider
            ]);

            // Login
            auth()->login($user);
            return redirect()->route('posts.index');
        } catch (Exception $e) {
            return redirect()->route('login');
        }
    }
}
