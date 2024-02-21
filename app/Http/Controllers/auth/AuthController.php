<?php
namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistirationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function login( LoginRequest $request)
    {
        if (Auth::attempt(["email" => $request->name."@franklin.mail","password"=> $request->password])) {
            return view("dashboard");
        }
        else {
            $this->authorize('create user',self::class);
            return view("auth.login",["message" => "Email or password is incorrect"]);
        }
    }

    public function showRegisterForm() {
        $this->authorize('create user',self::class);
        return view("auth.registiration");
    }

    public function register(RegistirationRequest $request)
    {
        $this->authorize('create user',self::class);
        $user = User::create([
            'name' => $request['name'],
            'middlename' => $request['middlename'],
            'lastname' => $request['lastname'],
            'email' => $request['name'].$request['lastname'].rand(1,10000)."@franklin.mail",
            'password' => bcrypt($request['password']),
        ]);
    
        return view("auth.registiration", ["message" => "ok"]);
    }

    














}



?>