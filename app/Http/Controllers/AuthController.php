<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use Socialite;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
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

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'getUsernameEdit']);
    }
    
    public function getUsernameEdit()
    {
        return view('editUsername');
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function facebookRedirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function facebookHandleProviderCallback(Request $request)
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return redirect(action('AuthController@facebookRedirectToProvider'));
        }

        $authUser = $this->findOrCreateUser($user, $request);

        Auth::login($authUser, true);

        return redirect()->back();
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $fbUser
     * @return User
     */
    private function findOrCreateUser($fbUser, $request)
    {
        if ($authUser = User::where('facebook_id', $fbUser->id)->first()) {
            return $authUser;
        }
        
        $request->session()->flash('info', 'If you wish to change your username click <a href="' . action('AuthController@getUsernameEdit') . '">here.</a>');

        return User::forceCreate([
            'username' => $fbUser->name,
            'email' => $fbUser->email,
            'facebook_id' => $fbUser->id
        ]);
    }
}
