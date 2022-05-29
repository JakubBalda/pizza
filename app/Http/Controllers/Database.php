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

    public function pizzaNames(){
        $this->pizzaNames =  DB::table('pizza')->select('Nazwa_pizzy')->get();
    }

    public function getPizzaNames(){
        $this->getSessionParams();
        $this->pizzaNames();

        return view('/editPizza', ['role'=>$this->role, 'pizzaName'=> $this->pizzaNames]);
    
    }

    public function getSelectedPizza(){
        $this->getSessionParams();
        $this->pizzaNames();

        if(isset($_GET['pizzaName'])){

            $pizza = DB::table('pizza')->where('Nazwa_pizzy', '=', $_GET['pizzaName'])->get();

        return view('/editPizza', ['role'=>$this->role, 'pizzaName'=> $this->pizzaNames, 'pizzaData'=>$pizza]);
        }else{
            return view('/editPizza', ['role'=>$this->role, 'pizzaName'=> $this->pizzaNames]);
        }
    }

    public function editPizzaData(){
        $this->getSessionParams();
        $this->pizzaNames();

        # TO:DO - dokończy edycje pizzy, zrobić dodawanie (funkcja addNewPizza()) oraz usuwanie(funkcja deletePizza()) 
    }
    
    public function addNewPizza(){

    }
    public function deletePizza(){
        $this->getSessionParams();

        if(isset($_GET['pizzaName'])){
           // DB::table('pizza')->where('Nazwa_pizzy','=', $_GET['pizzaName'])->delete();
        }

        $this->pizzaNames();
        return view('/editPizza', ['role'=>$this->role, 'pizzaName'=> $this->pizzaNames]);
    }
}
?>