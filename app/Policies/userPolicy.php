<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class userPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function isAdmin(user $user)
    {
        return $user->is_admin;
    }
}
