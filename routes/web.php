<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login;

    if(session_status() == PHP_SESSION_NONE)
        session_start();

    if(isset($_SESSION['login']) && isset($_SESSION['sessionrole'])){
        $this->rola = $_SESSION['sessionrole'];
        $this->login = $_SESSION['login'];
        $this->id = $_SESSION['id'];
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
    return view('main');
});

Route::get('/menu', function(){
    return view('menu');
});

Route::get('/loginSession', [login::class, 'login']);

Route::get('/logout', [login::class, 'logout']);

Route::get('/login', function(){
    return view('login');
});

Route::get('/register', function(){
    return view('register');
});
