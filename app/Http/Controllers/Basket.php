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

        $pid = $_GET['pizzaID'];
        
        if(isset($_GET['size'])){
            $pizza = DB::table('pizza')->where('ID', '=', $pid)->get();
            $basketID = $_GET['size'] . $pid; 
            
            foreach($pizza as $pizzaData){

                if($_GET['size'] == 'S'){
                    $price = $pizzaData->Cena+8;
                }else if($_GET['size'] == 'D'){
                    $price = $pizzaData->Cena+20;
                }else{
                    $price = $pizzaData->Cena;
                }
                if(!$pizza)
                    abort(404);
                
                $basket = session()->get('basket');

                if(!$basket){
                    $basket = [
                        $basketID =>[ 
                            
                            "ID" => $pid, 
                            "name" => $pizzaData->Nazwa_pizzy,
                            "qty" => 1,
                            "price" => $price,
                            "size" => $_GET['size']
                        ]
                    ];
                    session()->put('basket', $basket);
                    return redirect()->back()->with('success', 'Pizza dodana do koszyka!');
                    
                }
                

                if(isset($basket[$basketID])){
                    $basket[$basketID]['qty']++;
                    session()->put('basket', $basket);
                    return redirect()->back()->with('success', 'Pizza dodana do koszyka!');
                    
                }

                $basket[$basketID] = [
                    "ID" => $pid,
                    "name" => $pizzaData->Nazwa_pizzy,
                    "qty" => 1,
                    "price" => $price,
                    "size" => $_GET['size']
                ];
                session()->put('basket', $basket);
                return redirect()->back()->with('success', 'Pizza dodana do koszyka!');
                
            }
        }
        else
            return redirect()->route('menu');
    }

    public function removeFromCart(){
        
        $basketID = $_GET['size'].$_GET['pizzaID'];
        
        $basket = session()->get('basket');

        unset($basket[$basketID]);
        session()->put('basket', $basket);
        session()->flash('success', 'Pizza usunieta');
        
        return redirect()->back();
    }

    public function updateQty(Request $request){

        $basketID = $request->basketID;

        $basket = session()->get('basket');
        
        if(isset($basket[$basketID])){
            $basket[$basketID]['qty'] = $request->qty;

                if($request->qty == 0){
                    unset($basket[$basketID]);
                }
            session()->put('basket', $basket); 
            return response()->json(['success'=>'New qty']); 
        }
        
    }

    public function order(){
        $this->getSessionParams();
        $basket = session()->get('basket');

        DB::table('zamowienia')->insert([
            'Data_zamowienia'=> date("Y-m-d"),
            'Cena'=> $_GET['sum'],
            'Klient'=> $this->ID
        ]);

        $orderId = DB::table('zamowienia')->select('ID_zamowienia')->orderBy('ID_zamowienia', 'DESC')->first();

        foreach($orderId as $oID){
            foreach($basket as $bid=>$data){

                DB::table('zamowienia_pizza')->insert([
                    'ID_zamowienia'=> $oID,
                    'ID_pizzy'=> $data['ID'],
                    'Rozmiar'=> $data['size'],
                    'Ilosc'=> $data['qty'],
                ]);
        }
        }
        session()->flush();
        return redirect()->route('main');
        
    }
    
}