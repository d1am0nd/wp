<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Http\Requests;
use App\Http\Requests\Accounts\ChangeUsernameRequest;

class AccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getUsernameEdit(ChangeUsernameRequest $request)
    {
        return view('editUsername');
    }

    public function postUsernameEdit(ChangeUsernameRequest $request)
    {
        $user = Auth::user();
        $user->username = $request->input('username');
        $user->needs_new_username = false;
        $user->save();

        if($request->ajax())
            return json_encode('success');
        return redirect(action('GeneralController@getHome'));
    }

    public function getConfirmUsername(ChangeUsernameRequest $request)
    {
        $user = Auth::user();
        $user->needs_new_username = 0;
        $user->save();

        return redirect(action('GeneralController@getHome'));
    }
}
