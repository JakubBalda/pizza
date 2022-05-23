<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Register extends Controller{

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

    public function validateUser(Request $val){
        $val->validate(
            [
                'name'=>'required|regex:"[A-Z]{1}[a-z]"|min:3|max:25',
                'surname'=>'required|regex:"[A-Z]{1}[a-z]"|min:3|max:30',
                'street'=>'required|regex:"[A-Z]{1}[a-z]"|min:3|max:30',
                'house'=>'required|regex:"[0-9]"|min:1|max:3',
                'town'=>'required|regex:"[A-Z]{1}[a-z]"|min:3|max:40',
                'postal'=>'required|regex:"[0-9]{2}\-[0-9]{3}"',
                'phone'=>'required|regex:"^[0-9\-\+]{12,12}$"|unique:klienci,nr_telefonu',
                'mail'=>'required|min:7|max:40|unique:klienci,mail',
                'login'=>'required|regex:".\S"|min:3|max:30|unique:klienci,login',
                'password'=>'required|regex:"^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$"|min:8|max:40',
            ],
            [
                'name.regex'=>'Imię musi zaczynać się od dużej litery',
                'surname.regex'=>'Nazwisko musi zaczynać się od dużej litery',
                'street.regex'=>'Nazwa ulicy musi zaczynać się od dużej litery',
                'house.regex'=>'Numer domu może składać się tylko z cyfr',
                'town.regex'=>'Nazwa miasta musi zaczynać się od dużej litery',
                'postal.regex'=>'Kod pocztowy musi składać się z 5 cyfr z myślnikiem w formie: [xx-xxx], x = cyfra',
                'phone.regex'=>'Numer telefonu musi być w formie: [+48xxxxxxxxx], x = cyfra',
                'login.regex'=>'Login może być z dowolnych znaków',
                'password.regex'=>'Hasło musi być silne (minimum 1 duża litera, 1 mała litera, 1 znak spcjalny, 1 cyfra, minimum 8 znaków długości)',
                'required'=>'Pole :attribute nie może być puste!',
                'unique'=>'Podany :attribute już istnieje!'
            ]
        );
    }

    public function registerUser(Request $val){

        $this->getSessionParams();
        $this->validateUser($val); 

        if(!isset($_GET['role'])){
            DB::table('klienci')->insert([
                'Imie' => $_GET['name'],
                'nazwisko' => $_GET['surname'],
                'ulica' => $_GET['street'],
                'nr_domu' => $_GET['house'],
                'miasto' => $_GET['town'],
                'nr_mieszkania' => $_GET['flat'],
                'kod_pocztowy' => $_GET['postal'],
                'nr_telefonu' => $_GET['phone'],
                'mail' => $_GET['mail'],
                'login' => $_GET['login'],
                'haslo' => $_GET['password'],
                'rola'=>'Klient'
            ]);

            echo '<script type="text/javascript">
                    alert("Zarejestrowano poprawnie! Zaloguj się!");
                </script>';

            return view('main');
        }else{
            DB::table('klienci')->insert([
                'Imie' => $_GET['name'],
                'nazwisko' => $_GET['surname'],
                'ulica' => $_GET['street'],
                'nr_domu' => $_GET['house'],
                'miasto' => $_GET['town'],
                'nr_mieszkania' => $_GET['flat'],
                'kod_pocztowy' => $_GET['postal'],
                'nr_telefonu' => $_GET['phone'],
                'mail' => $_GET['mail'],
                'login' => $_GET['login'],
                'haslo' => $_GET['password'],
                'rola'=>$_GET['role']
            ]);

            echo '<script type="text/javascript">
                    alert("Dodano nowego użytkownika");
                </script>';

            return view('main', ['role'=>$this->role]);
        }
        
    }
}