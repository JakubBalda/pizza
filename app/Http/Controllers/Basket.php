<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class Basket extends Controller{
    
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

    public function addToCart(){
        $this->getSessionParams();

        if(isset($_GET['size']))
            return view('cart', ['role'=>$this->role]);
        else
            return redirect()->route('menu');
    }
    
    public function showCart(){
        $this->getSessionParams();

        Cart::getContent();
    }
}