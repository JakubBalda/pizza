<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class Database extends Controller{

    public function validateNewPizza(Request $val){
        $val->validate(
            [
                'pizzaName'=>'required|regex:"#^\p{L}+$#u"|min:5|max:20',
                'ingrids'=>'required|regex:"#^\p{L}+$#u"|min:5|max:200',
                'price'=>'required|regex:"/^[0-9]{1,2}(\.|,)[0-9]{2}$/"'
            ],
            [
                'required'=>'Pole :attribute jest wymagane',
                'price.regex'=>'Zły format ceny',
                'pizzaName.regex'=>'Nazwa pizzy może składać się tylko z liter',
                'ingrids.regex'=>'Składniki mogą składać się tylko z liter'
            ]
        );
    }

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

        # TO:DO - dokończy edycje pizzy, zrobić dodawanie (funkcja addNewPizza()) oraz 
    }
    
    public function addNewPizza(Request $val){
        $this->getSessionParams();
    }
    public function deletePizza(){
        $this->getSessionParams();

        if(isset($_GET['pizzaName']) && isset($_GET['confirm'])){
            
            DB::table('pizza')->where('Nazwa_pizzy','=', $_GET['pizzaName'])->delete();
        }

        $this->pizzaNames();
        return view('/editPizza', ['role'=>$this->role, 'pizzaName'=> $this->pizzaNames]);
    }
}
?>