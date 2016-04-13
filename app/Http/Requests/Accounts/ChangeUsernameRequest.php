<?php

namespace App\Http\Requests\Accounts;

use Auth;
use App\Http\Requests\Request;

class ChangeUsernameRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!Auth::check() || Auth::user()->needs_new_username == 0)
            return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(Request::method() == 'GET')
            return [];
        return [
            'username' => 'required|max:30|unique:users,username',
        ];
    }
}
