<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class CustomerPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        // ddd();
    }

    public function index() {
      if(Auth::user()->hasPermissionTo("show customer list")) {
        return  true;
      }
      else {
        return false;
      }
    }
    public function create() {
      if(Auth::user()->hasPermissionTo("create customer")) {
        return  true;
      }
      else {
        return false;
      }
    }
    public function edit() {
      if(Auth::user()->hasPermissionTo("edit customer")) {
        return  true;
      }
      else {
        return false;
      }
    }
}
