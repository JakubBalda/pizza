<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\Database;
use App\Http\Controllers\Register;
use App\Http\Controllers\User;

    if(session_status() == PHP_SESSION_NONE)
        session_start();

    if(isset($_SESSION['login']) && isset($_SESSION['sessionrole'])){
        $this->role = $_SESSION['sessionrole'];
        $this->login = $_SESSION['login'];
        $this->ID = $_SESSION['id'];
    }else{
        $this->role = null;
    }

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
    return view('main', ['role'=>$this->role]);
});

Route::get('/registerUser', [Register::class, 'registerUser'] );

Route::get('/menu', [Database::class, 'showPizza'] );

Route::get('/loginSession', [Login::class, 'login']);

Route::get('/logout', [Login::class, 'logout'])->name('logout');

Route::get('/login', function(){
    return view('login');
});

Route::get('/register', function(){
    return view('register');
});

Route::get('/registerUserByAdmin', function(){
    return view('registerAdmin', ['role'=>$this->role]);
});

Route::get('/userPanel', [Database::class, 'getUserData'] );

Route::get('/editUserData', [User::class, 'editUserData'] );

Route::get('/editUserPassword', [User::class, 'editUserPassword'] );

Route::get('/deleteAccount', [User::class, 'deleteAccount'] );

Route::get('/editPizza', [Database::class, 'getPizzaNames'] );

Route::get('/getSelectedPizza', [Database::class, 'getSelectedPizza'] );

Route::get('/editPizzaData', [Database::class, 'editPizzaData'] );

