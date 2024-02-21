<?php
namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class UsersController extends Controller {

    public function index() {
        return view("auth.users",
        [
            "users" => User::paginate(10)
        ]
    );
    }

    public function edit(User $user) {
        $added = false;
        if($user->hasPermissionTo(request()->input("permission"))) {
            $user->revokePermissionTo(request()->input("permission"));
        }
        else {
            $added = true;
            $user->givePermissionTo(request()->input("permission"));
        }
             
        return view("auth.showuser",[
            "user" => $user,
            "message" => ($added)?request()->input("permission")." icazesi verildi":request()->input("permission")." icazesi silindi",
            "permissions" => Permission::all()
        ]);
    }

    public function show(User $user) {
        $this->authorize('show user',self::class);
        return view("auth.showuser",[
            "user" => $user,
            "permissions" => Permission::all()
        ]);
    }

}





?>