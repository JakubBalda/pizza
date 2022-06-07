<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\Database;
use App\Http\Controllers\Register;
use App\Http\Controllers\User;
use App\Http\Controllers\Basket;

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
})->name('main');

Route::get('/menu', [Database::class, 'showPizza'] )->name('menu');

if(!isset($this->role)){
    Route::get('/registerUser', [Register::class, 'registerUser'] );

    Route::get('/login', function(){
        return view('login');
    });

    Route::get('/loginSession', [Login::class, 'login']);

    Route::get('/register', function(){
        return view('register');
    });
}

if(isset($this->role)){

    Route::get('/logout', [Login::class, 'logout'])->name('logout');

    Route::get('/userPanel', [Database::class, 'getUserData'] );

    Route::get('/editUserData', [User::class, 'editUserData'] );

    Route::get('/editUserPassword', [User::class, 'editUserPassword'] );

    Route::get('/deleteAccount', [User::class, 'deleteAccount'] );

    Route::get('/addToCart', [Basket::class, 'addToCart'] );

    Route::get('/remove', [Basket::class, 'removeFromCart'] );

    Route::get('/updateQty', [Basket::class, 'updateQty'] );

    Route::get('/order', [Basket::class, 'order'] );

    Route::get('/myCart', function(){
        return view('cart', ['role'=>$this->role]);
    })->name('cart');
}else{
    
}

if(isset($this->role) && $this->role == 'Admin'){

    Route::get('/registerUserByAdmin', function(){
        return view('registerAdmin', ['role'=>$this->role]);
    });

    Route::get('/editPizza', [Database::class, 'getPizzaNames'] )->name('editPizza');

    Route::get('/getSelectedPizza', [Database::class, 'getSelectedPizza'] );

    Route::get('/editPizzaData', [Database::class, 'editPizzaData'] );

    Route::get('/deletePizza', [Database::class, 'deletePizza'] );

    Route::get('/addPizza', [Database::class, 'addNewPizza'] );
    }




Route::get('/sort', [Database::class, 'sortMenu'] );


    