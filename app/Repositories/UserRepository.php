<?php 

namespace App\Repositories;

use Hash;
use App\User;

class UserRepository implements UserRepositoryInterface {

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function createUser($attributes)
    {
        $attributes['password'] = Hash::make($attributes['password']);
        return $this->user->create($attributes);
    }
}