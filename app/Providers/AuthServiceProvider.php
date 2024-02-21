<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\UsersController;
use App\Http\Controllers\CreditController;
use App\Models\Customer;
use App\Policies\CustomerPolicy;
use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\CustomerController;
use App\Models\Credit;
use App\Policies\CreditPolicy;
use App\Policies\Customer as PoliciesCustomer;
use App\Policies\UserPolicy;
use Illuminate\Auth\Access\Gate as AccessGate;
use Illuminate\Contracts\Auth\Access\Gate as AuthAccessGate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        CustomerController::class => CustomerPolicy::class,
        // CreditController::class => CreditPolicy::class,
        UsersController::class => UserPolicy::class,
        AuthController::class => UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
     
        // $this->registerPolicies();
     
  
    }
}
