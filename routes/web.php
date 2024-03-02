<?php

use App\DTOS\PaymentDTO;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\UsersController;
use App\Http\Controllers\Calculator;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\StaticsController;
use App\Models\Credit;
use App\Models\Payment;
use App\Workers\PaymentWoker;
use App\Workers\PercentageWorker;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/",[Calculator::class,"index"]);
Route:: post("/calculator",[Calculator::class,"calculate"]);






// Users

Route::get("/auth/users",[UsersController::class,"index"]);
Route::get("/auth/users/show/{user}",[UsersController::class,"show"]);
Route::post("/auth/users/show/{user}/edit",[UsersController::class,"edit"]);


// Calculator
Route::get("/calculator",[Calculator::class,"index"]);
Route:: post("/calculator",[Calculator::class,"calculate"]);




// Customer routes
Route::resource("/customers",CustomerController::class);




// Credits routes
Route::resource("/credits",CreditController::class)->only(["store","edit","destroy","update","index","show"])->except(["create"]);
Route::get("/credits/create/{customer}",[CreditController::class,"create"]);
Route::get("/credits/showcheck/{credit}",[CreditController::class,"showCehck"]);




// Payments 
Route::get("/payments/pay/{credit}",[PayController::class,"index"]);
Route::post("/payments/pay",[PayController::class,"create"]);
Route::get("/payments/showcheck/{payment}",[PayController::class,"showCehck"]);
// Statics
Route::get("/statics",[StaticsController::class,"index"]);




// Auth routes
Route::get("/auth/login",function() {
    return view("auth.login");
});
Route:: post('/auth/login',[AuthController::class,"login"]);

Route::get("/auth/register",[AuthController::class,"showRegisterForm"]);
Route::post('/auth/register',[AuthController::class,"register"]);
