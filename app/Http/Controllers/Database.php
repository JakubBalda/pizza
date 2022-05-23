<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


class Database extends Controller{

    public function showPizza(){
        $this->getSessionParams();
        $pizza = DB::table('pizza')->get();

        return view('/menu', compact('pizza'), ['role'=>$this->role]);
    }

    public function getSessionParams(){
        if(session_status() == PHP_SESSION_NONE)
            session_start();

        if(isset($_SESSION['login']) && isset($_SESSION['sessionrole'])){
            $this->role = $_SESSION['sessionrole'];
            $this->login = $_SESSION['login'];
            $this->ID = $_SESSION['id'];
        }else{
            $this->role = null;
        }
    }

    public function getUserData(){
        $this->getSessionParams();

        $user = DB::table('klienci')->where('ID_klienta', '=',$this->ID)->get();
        

        return view('/userPanel', ['role'=>$this->role, 'user'=>$user]);
    }

    
}
?>