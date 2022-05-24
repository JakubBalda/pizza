<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;

class User extends Controller
{

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

    public function validateNewPassword(Request $val){
        $val->validate(
            [
                'new-password'=>'required|regex:"^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$"|min:8|max:40|same:new-password-2',
            ],
            [
                'new-password.regex'=>'Hasło musi być silne (minimum 1 duża litera, 1 mała litera, 1 znak spcjalny, 1 cyfra, minimum 8 znaków długości)',
                'required'=>'Pole :attribute nie może być puste!',
                'same'=>'Błędnie powtórzone hasło!'
            ]
        );
    }

    public function validateUpdates(Request $val){
        $val->validate(
            [
                'name'=>'required|regex:"[A-Z]{1}[a-z]"|min:3|max:25',
                'surname'=>'required|regex:"[A-Z]{1}[a-z]"|min:3|max:30',
                'street'=>'required|regex:"[A-Z]{1}[a-z]"|min:3|max:30',
                'house'=>'required|regex:"[0-9]"|min:1|max:3',
                'town'=>'required|regex:"[A-Z]{1}[a-z]"|min:3|max:40',
                'postal'=>'required|regex:"[0-9]{2}\-[0-9]{3}"',
                'phone'=>'required|regex:"^[0-9\-\+]{12,12}$"',
                'mail'=>'required|regex:"^[a-z0-9]+\@[a-z]+\.[a-z]+"|min:7|max:40',
                'login'=>'required|regex:".\S"|min:3|max:30|',
            ],
            [
                'name.regex'=>'Imię musi zaczynać się od dużej litery',
                'surname.regex'=>'Nazwisko musi zaczynać się od dużej litery',
                'street.regex'=>'Nazwa ulicy musi zaczynać się od dużej litery',
                'house.regex'=>'Numer domu może składać się tylko z cyfr',
                'town.regex'=>'Nazwa miasta musi zaczynać się od dużej litery',
                'postal.regex'=>'Kod pocztowy musi składać się z 5 cyfr z myślnikiem w formie: [xx-xxx], x = cyfra',
                'phone.regex'=>'Numer telefonu musi być w formie: [+48xxxxxxxxx], x = cyfra',
                'mail.regex'=>'Mail musi być w formie: [np. xyzabcd@domena.com]',
                'login.regex'=>'Login może być z dowolnych znaków',
                'required'=>'Pole :attribute nie może być puste!',
                'unique'=>'Podany :attribute już istnieje!'
            ]
        );
    }


    public function editUserData(Request $val){
        $this->validateUpdates($val); 
        $this->getSessionParams();
        
        DB::table('klienci')->where('ID_klienta', $this->ID)->update([
            'Imie'=> $_GET['name'],
            'Nazwisko' => $_GET['surname'],
            'Ulica' => $_GET['street'],
            'Nr_domu' => $_GET['house'],
            'Nr_mieszkania' => $_GET['flat'],
            'Miasto' => $_GET['town'],
            'Kod_pocztowy' => $_GET['postal'],
            'Login' => $_GET['login'],
            'Nr_telefonu' => $_GET['phone'],
            'Mail' => $_GET['mail'],
        ]);

        $user = DB::table('klienci')->where('ID_klienta', '=',$this->ID)->get();

        echo '<script type="text/javascript">
                    alert("Zmiany zostały zapisane!");
                </script>';

        return view('userPanel', ['role'=>$this->role, 'user'=>$user]);

    }

    public function editUserPassword(Request $val){
        $this->getSessionParams();
        $this->validateNewPassword($val); 

        $user = DB::table('klienci')->where('ID_klienta', '=',$this->ID)->get();
        $userPassword = DB::table('klienci')->where('ID_klienta', '=',$this->ID)->value('Haslo');

        if($_GET['new-password'] != $userPassword){

            DB::table('klienci')->where('ID_klienta', $this->ID)->update(['Haslo'=>$_GET['new-password']]);

            echo '<script type="text/javascript">
                    alert("Hasło zmienione poprawnie");
                </script>';

            return view('userPanel', ['role'=>$this->role, 'user'=>$user]);

        }else{
            echo '<script type="text/javascript">
                    alert("Nowe hasło nie może być starym hasłem");
                </script>';
            return view('userPanel', ['role'=>$this->role, 'user'=>$user]);
        }
    }

    public function deleteAccount(){
        $this->getSessionParams();


        DB::table('klienci')->where('ID_klienta','=', $this->ID)->delete();


        return redirect()->route('logout');

    }

    
}

?>