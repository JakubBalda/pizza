<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


class login extends Controller
{
    public $login;
    public $role;
    public $ID;

    public function login(){

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

            $_SESSION['sessionrole'] = $this->Rola;
            $_SESSION['login'] = $this->login;
            $_SESSION['id'] = $this->ID;

            return view('main', ['role'=>$this->role]);
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