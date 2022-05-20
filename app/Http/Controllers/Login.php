<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Login extends Controller
{
    public $login;
    public $role;
    public $ID;

    public function loginValidate(Request $val){
        $val->validate(
            [
                'login'=>'required|exists:klienci',
                'password'=>'required'
            ],
            [
                'required'=>'Pole :attribute jest wymagane!',
                'exists'=>'Podany login nie istnieje'
            ]
        );  
    }

    public function login(Request $val){

        $this->loginValidate($val);
        
        $userLogin = $_GET['login'];
        $userPassword = $_GET['password'];

        $user = DB::table('klienci')->where('Login', $userLogin)->first();

        $this->login = $user->Login;
        $this->role = $user->Rola;
        $this->ID = $user->ID_klienta;
        $dbPass = $user->Haslo;

        if($this->login == $userLogin && $dbPass == $userPassword){


            if(session_status() == PHP_SESSION_NONE)
                session_start();

            $_SESSION['sessionrole'] = $this->role;
            $_SESSION['login'] = $this->login;
            $_SESSION['id'] = $this->ID;

            return view('main', ['role'=>$this->role, 'ID'=>$this->ID]);
        }else{
            return view('login');
        }
    }

    public function logout(){
        if(session_status() == PHP_SESSION_NONE)
                session_start();

        session_destroy();

        return view('main');
    }
}


?>