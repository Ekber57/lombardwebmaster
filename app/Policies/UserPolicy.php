<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function show() {
        if(Auth::user()->hasPermissionTo("show user")) {
            return  true;
          }
          else {
            return false;
          }
    }
    public function register() {
        if(Auth::user()->hasPermissionTo("create user")) {
            return  true;
          }
          else {
            return false;
          }
    }


}
