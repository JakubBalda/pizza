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

                        @isset($role)<button onclick="location='userPanel'" class="btn btn-primary ml-auto mr-15">{{$role}}</button>@endif
                    
                        @if(!isset($role))<button onclick="location='login'" class="btn btn-primary text-white ml-auto mr-15">
                            <i class="icon-login"> Zaloguj się</i>
                        </button>@else<button onclick="location='logout'" class="btn btn-primary text-white ml-auto mr-15">
                            <i class="icon-login"> Wyloguj się</i>
                        </button>@endif
                    </div>

                </nav>

                
            </div>

            <div class="content-wrapper">
                
                
                    <?php $sum = 0?>
                    @if(session('basket'))
                    @foreach(session('basket') as $id => $infos)
                    <div class="mt-50 d-flex flex-column ">
                    <h2 class="ml-10">Mój koszyk</h2>
                        <div class="card d-flex mt-10 shadow w-750 align-self-center">
                        <?php $total = 0?>
                        
                                <?php $total += $infos['price'] * $infos['qty']; $sum += $total ?>

                                <div class="container-fluid text-uppercase">
                                    <div class="row align-self-center">
                                        <div class="col-2 align-self-center">
                                            <img class="round" src="img/pizza-kurczak.jpg"/>
                                        </div>
                                        <div class="col-4 d-flex flex-column align-self-center">
                                            <div class="font-size-20">{{$infos['name']}}</div>
                                        </div>

                                        <div class="col-4 d-flex align-self-center justify-content-center font-size-20">
                                            <div class="m-20">
                                                {{$infos['price']}}
                                            </div>
                                            <div class="m-20">
                                                {{$infos['qty']}} 
                                            </div>
                                            <div class="m-20">
                                            {{$infos['size']}}
                                            </div>
                                        </div>
                                        
                                        <div class="col-1 d-flex align-self-center justify-content-center font-size-20">
                                            <div class="m-20">
                                                {{$total}}
                                            </div>
                                        </div>

                                        <div class="col-1 align-self-center">
                                            <form action="remove" method="get">
                                                <input type="hidden" value="{{$infos['ID']}}" name="pizzaID">
                                                <input type="hidden" value="{{$infos['size']}}" name="size">
                                                <button class="ml-10 btn btn-danger d-flex align-self-center" type="submit">
                                                    <i class="icon-basket"></i>
                                                </button>
                                            </form>

                                            <form action="decrement" method="get">
                                                <input type="hidden" value="{{$infos['ID']}}" name="pizzaID">
                                                <input type="hidden" value="{{$infos['size']}}" name="size">
                                                <button class="ml-10 btn btn-primary d-flex align-self-center" type="submit">
                                                    <i class="icon-basket"></i>
                                                </button>
                                            </form>

                                            <form action="increment" method="get">
                                                <input type="hidden" value="{{$infos['ID']}}" name="pizzaID">
                                                <input type="hidden" value="{{$infos['size']}}" name="size">
                                                <button class="ml-10 btn btn-secondary d-flex align-self-center" type="submit">
                                                    <i class="icon-basket"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                    @endforeach
                    <div>{{$sum}}</div>
                    <div></div>
                </div>
                @else
                <div class="mt-50 d-flex flex-column h-full">
                    <h3 class="ml-10">Koszyk jest pusty</h3>
                </div>
                @endif
                
                

                
                <div class="d-flex">
                    <footer class="pl-20 bg-dark-light w-full text-white font-weight-semi-bold">
                        <span>&copy: Wszelkie prawa zastrzeżone</span>
                    </footer>
                </div>
            </div>

    </body>
</html>