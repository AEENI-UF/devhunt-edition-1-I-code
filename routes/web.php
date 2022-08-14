<?php

use Illuminate\Support\Facades\Route;

use App\Http\Closure;
use App\Http\Log;
use Illuminate\Http\Request;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name("index");

Route::get("/creation-compte", function(){
    return view("page.creation-compte");
})->name("creation-compte");

Route::post("/sign-in", [UserController::class, 'creat'])->name("sign-in");
Route::post("/login", [UserController::class, "login"])->name("login");

Route::get("/confirmation", function(){
    return view("page/confirmation");
})->name("confirmation");

Route::get("/deconnexion", [UserController::class, "logout"])->name("deconnexion");



Route::get("/user", [UserController::class, "userIndex"])->name("user.index");

Route::get("/dashboard", function(){
    if(auth()->user()->isadmin){
        return view("page/admin/dashboard");
    }
    return redirect(route("index"))->with("notif", "Seul un administrateur peut acceder à cette page !");
})->name("dashboard");

Route::post("/confirm", [UserController::class, "confirmCode"])->name("confirm");

Route::post("/getLimitation", [AdminController::class, "getLimitation"])->name("getLimitation");
Route::post("/saveLimitation", [AdminController::class, "saveLimitation"])->name("saveLimitation");
Route::post("/updteTime", [UserController::class, "updteTime"])->name("updteTime");