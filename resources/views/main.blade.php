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
                <nav class="navbar ">
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
                            <a href="#" class="nav-link">Dostawa</a>
                        </li>
                        <li class="new-item active mt-auto mb-auto">
                            <a href="#" class="nav-link">Promocje</a>
                        </li>
                        <li class="new-item active mt-auto mb-auto">
                            <a href="#kontakt" class="nav-link">Kontakt</a>
                        </li>
                        
                    </ul>
                    <a href="#" class="text-white ml-auto"><button class="btn btn-primary">
                        <i class="icon-login">Zaloguj się</i>
                    </button></a>
                </nav>

                
            </div>

            <div class="content-wrapper">
                
                <div class="d-flex justify-content-around h-full">
                    <div class="content h-25 mt-70">
                        <div class="card shadow">
                            <h2 class="card-title">Nasze pizze</h2>
                            <p>Zobacz naszą ofertę</p>
                            <img src="img/pizza.jpg" class="img-fluid" alt="pizza"/>
                            <div class=" position-absolute right-0 m-15">
                                <a href="{{ url('/menu') }}"><button class="btn btn-primary">Zobacz ofertę</button></a>
                            </div>
                        </div>
                    </div>

                    <div class="mt-120">
                        <div class="card shadow">
                            <h2 class="card-title">Promocje</h2>
                            <img src="img/pizza-promotion.png" class="img-fluid" alt="pizza"/>
                            <div class=" position-absolute right-0 m-15">
                                <a href="#"><button class="btn btn-primary">Sprawdź</button></a>
                            </div>
                        </div>
                    </div>

                    <div class="mt-120">
                        <div class="card shadow">
                            <h2 class="card-title">Kontakt</h2>
                            <img src="img/pizza-phone.jpg" class="img-fluid" alt="pizza"/>
                            <div class=" position-absolute right-0 m-15">
                                <a href="#kontakt"><button class="btn btn-primary">Zadzwoń</button></a>
                            </div>
                        </div>
                    </div>
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

                <div class="d-flex">
                    <footer class="pl-20 bg-dark-light w-full text-white font-weight-semi-bold">
                        <span>&copy: Wszelkie prawa zastrzeżone</span>
                    </footer>
                </div>
            </div>

            
                
    </body>
</html>