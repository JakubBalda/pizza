<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Register extends Controller{

    public function validateUser(Request $val){
        $val->validate(
            [
                'name'=>'required|regex:"[A-Z]{1}[a-z]"|min:3|max:25',
                'surname'=>'required|regex:"[A-Z]{1}[a-z]"|min:3|max:30',
                'street'=>'required|regex:"[A-Z]{1}[a-z]"|min:3|max:30',
                'house'=>'required|regex:"[0-9]"|min:1|max:3',
                'town'=>'required|regex:"[A-Z]{1}[a-z]"|min:3|max:40',
                'flat'=>'regex:"[0-9]"|min:1|max:3',
                'postal'=>'required|regex:"[0-9]{2}\-[0-9]{3}"',
                'phone'=>'required|regex:"^[0-9\-\+]{12,12}$"|unique:klienci,nr_telefonu',
                'mail'=>'required|regex:"^[a-z0-9]+\@[a-z]+\.[a-z]+"|min:7|max:40|unique:klienci,mail',
                'login'=>'required|regex:".\S"|min:3|max:30|unique:klienci,login',
                'password'=>'required|regex:"^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8}$"|min:8|max:40',
            ],
            [
                'name.regex'=>'Imię musi zaczynać się od dużej litery',
                'surname.regex'=>'Nazwisko musi zaczynać się od dużej litery',
                'street.regex'=>'Nazwa ulicy musi zaczynać się od dużej litery',
                'house.regex'=>'Numer domu może składać się tylko z cyfr',
                'town.regex'=>'Nazwa miasta musi zaczynać się od dużej litery',
                'flat.regex'=>'Numer mieszkania może składać się tylko z cyfr',
                'postal.regex'=>'Kod pocztowy musi składać się z 5 cyfr z myślnikiem w formie: [xx-xxx], x = cyfra',
                'phone.regex'=>'Numer telefonu musi być w formie: [+48xxxxxxxxx], x = cyfra',
                'mail.regex'=>'Mail musi być w formie: [np. xyzabcd@domena.com]',
                'login.regex'=>'Login może być z dowolnych znaków',
                'password.regex'=>'Hasło musi być silne (minimum 1 duża litera, 1 mała litera, 1 znak spcjalny, 1 cyfra, minimum 8 znaków długości)',
                'required'=>'Pole :attribute nie może być puste!',
                'unique'=>'Podany :attribute już istnieje!'
            ]
        );
    }

    public function registerUser(Request $val){

        $this->validateUser($val); 

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

        return view('main');
    }
}