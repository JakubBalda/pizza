<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pizzeria Grande</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/css/halfmoon-variables.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/js/halfmoon.min.js"></script>
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="css/css/fontello.css" type="text/css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    </head>
    <body class="bg-light">
            <div class="page-wrapper with-navbar">
                <nav class="navbar d-flex justify-content-between">

                    <div class="d-flex">
                        <a href="{{ url('/') }}" class="navbar-brand">
                            <img src="img/pizza-navbar.png"/>
                            Grande Pizza 
                        </a>
                        
                        <span class="navbar-text text-monospace text-dark "> Piekary Śląskie</span>

                        <ul class="navbar-nav d-none d-md-flex font-weight-semi-bold">
                            <li class="new-item active mt-auto mb-auto">
                                <a href="{{ url('/menu') }}" class="nav-link">Menu</a>
                            </li>
                            <li class="new-item active mt-auto mb-auto">
                                <a href="{{ url('/') }}#dostawa" class="nav-link">Dostawa</a>
                            </li>
                            
                            <li class="new-item active mt-auto mb-auto">
                                <a href="{{ url('/') }}#kontakt" class="nav-link">Kontakt</a>
                            </li>
                            
                        </ul>
                    </div>

                    <div class="d-flex">
                        @if($role == "Admin")<button onclick="location='editPizza'" class="btn btn-primary ml-auto mr-15">Edytuj</button>@endif

                        @isset($role)<button onclick="location='myCart'" class="btn btn-primary ml-auto mr-15"><i class="icon-basket"></i></button>@endif

                        @isset($role)<button onclick="location='userPanel'" class="btn btn-primary mr-15"><i class="icon-user"> {{$role}}</i></button>@endif
                    
                        @if(!isset($role))<button onclick="location='login'" class="btn btn-primary text-white ml-auto mr-15">
                            <i class="icon-login"> Zaloguj się</i>
                        </button>@else<button onclick="location='logout'" class="btn btn-primary text-white ml-auto mr-15">
                            <i class="icon-login"> Wyloguj się</i>
                        </button>@endif
                    </div>
                </nav>
            </div>

            <div class="content-wrapper">
                
                <div class="mt-50 d-flex flex-column">
                    <div class="content">
                        <h1 class="content-title ml-5 font-size-36">Menu</h1>
                        Sortuj po ID:
                        <form action="sort" method="get">
                            <select name="sort">
                                <option value="" selected disabled></option>
                                <option value="ASC">Rosnąco</option>
                                <option value="DESC">Malejąco</option>
                            </select>
                            <button type="submit" class="ml-5 btn btn-primary">Zatwierdź</button>
                        </form>
                    </div>
                    <?php
                        $p = session()->pull('pizza');
                        if($p){
                            $pizza = $p;
                        }
                    ?>
                    @foreach($pizza as $pizzaData)
                    <div class="card d-flex mt-10 shadow">
                        <div class="container-fluid text-uppercase">
                            <div class="row align-self-center">
                                <div class="col-2 align-self-center">
                                    <img class="round" src="img/pizza-kurczak.jpg"/>
                                </div>
                                <div class="col-4 d-flex flex-column align-self-center">
                                    <div class="font-size-20">{{$pizzaData->ID}}. {{$pizzaData->Nazwa_pizzy}}</div>
                                    <div class="font-size-4 text-lowercase">{{$pizzaData->Skladniki}}</div>
                                </div>
                                <div class="col-5 d-flex align-self-center justify-content-center font-size-20">
                                    <div class="m-20">
                                        @php
                                            $cena = $pizzaData->Cena * 10;
                                            $cena = bcdiv($cena, 10, 2);    
                                            echo $cena;
                                        @endphp
                                    </div>
                                    <div class="m-20">
                                    @php
                                            $cena = ($pizzaData->Cena+8) * 10;
                                            $cena = bcdiv($cena, 10, 2);    
                                            echo $cena;
                                        @endphp
                                    </div>
                                    <div class="m-20">
                                    @php
                                            $cena = ($pizzaData->Cena+20) * 10 ;
                                            $cena = bcdiv($cena, 10, 2);    
                                            echo $cena;
                                        @endphp
                                    </div>
                                </div>
                                <div class="col-1 align-self-center">
                                    <form action="addToCart" method="get" class="d-flex">

                                        <input type="hidden" name="pizzaID" value="{{$pizzaData->ID}}">
                                        <select name="size">
                                            <option value="" disabled selected></option>
                                            <option value="M">M</option>
                                            <option value="S">S</option>
                                            <option value="D">D</option>
                                        </select>

                                        @isset($role)<button class="ml-10 btn btn-success d-flex align-self-center" type="submit">
                                            <i class="icon-basket"></i>
                                        </button>@endif
                                    
                                    </form>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                    @endforeach
                    @if(!$p)
                    <span>
                        {{$pizza->links("pagination::bootstrap-4")}}
                    </span>
                    @endif
                </div>

                <div id="kontakt" class="d-flex w-full h-150 bg-dark-light text-light">
                    <div class="container-fluid mt-15 font-size-18">
                        <div class="row">
                            <div class="col-4 d-flex flex-column">
                                <div class="align-self-center font-size-22 font-weight-semi-bold">
                                    Grande Pizza
                                </div>
                                <div class="align-self-center">41-940 Piekary Śląskie</div>
                                <div class="align-self-center">ul. Karola Miarki 12</div>
                                <div class="align-self-center">
                                    <i class="icon-phone"></i>: 559668425
                                </div>
                            </div>
                            <div class="col-5 d-flex flex-column ">
                                <div class="align-self-center ">
                                    <a href="#" class="text-light">Regulamin</a>
                                </div>
                                <div class="align-self-center">
                                    <a href="#" class="text-light">Polityka prywatności</a>
                                </div>
                            </div>
                            <div class="col-3 d-flex flex-column font-size-50">
                                <a href="#" class="align-self-center text-light"><i class="icon-facebook-squared "></i></a>
                                <a href="#" class="align-self-center text-light"><i class="icon-mail "></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex position-fixed bottom-0 w-full">
                    <footer class="pl-20 bg-dark-light w-full text-white font-weight-semi-bold">
                        <span>&copy: Wszelkie prawa zastrzeżone</span>
                    </footer>
                </div>
            </div>

    </body>
</html>