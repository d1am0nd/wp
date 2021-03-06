<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use Socialite;
use Validator;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Requests\Accounts\CreateUserRequest;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function getCurrentUser()
    {
        return Auth::check() ? Auth::user() : null;
    }

    public function postLogin(Request $request)
    {
        return Auth::attempt(['email' => $request->input('email'),
        'password' => $request->input('password')]) ? Auth::user() : null;
    }

    public function postCreateUser(CreateUserRequest $request)
    {
        $user = $this->user->createUser($request->input());
        return Auth::login($user);
    }

    public function getLogout()
    {
        return Auth::logout();
    }


    // ***** Social login ***** //

    /**
     * Redirect the user to the social authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        if($provider == 'google'){
            // Only request the info we need
            $scopes = [
                'https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/userinfo.profile'
            ];
            return Socialite::driver($provider)->scopes($scopes)->redirect();
        }
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect(action('AuthController@redirectToProvider'));
        }

        $authUser = $this->findOrCreateUser($user, $provider);

        Auth::login($authUser, true);

        return redirect(action('GeneralController@getHome'));
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $fbUser
     * @return User
     */
    private function findOrCreateUser($user, $provider)
    {
        if ($authUser = User::where($provider . '_id', $user->id)->first()) {
            return $authUser;
        }

        return User::forceCreate([
            'username' => $user->name,
            'email' => $user->email,
            $provider . '_id' => $user->id,
            'needs_new_username' => 1
        ]);
    }
}
