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
    </head>
    <body class="bg-light">
            <div class="page-wrapper with-navbar with-navbar-fixed-bottom">
                <nav class="navbar ">
                    <a href="#" class="navbar-brand">
                        <img src="img/pizza-navbar.png"/>
                        Grande Pizza 
                    </a>
                    
                    <span class="navbar-text text-monospace text-dark "> Piekary Śląskie</span>

                    <ul class="navbar-nav d-none d-md-flex font-weight-semi-bold">
                        <li class="new-item active mt-auto mb-auto">
                            <a href="#" class="nav-link">Menu</a>
                        </li>
                        <li class="new-item active mt-auto mb-auto">
                            <a href="#" class="nav-link">Dostawa</a>
                        </li>
                        <li class="new-item active mt-auto mb-auto">
                            <a href="#" class="nav-link">Promocje</a>
                        </li>
                        <li class="new-item active mt-auto mb-auto">
                            <a href="#" class="nav-link">Kontakt</a>
                        </li>
                        
                    </ul>
                    <a href="#" class="text-white ml-auto"><button class="btn btn-primary ">Zaloguj się</button></a>
                </nav>

                <nav class="navbar navbar-fixed-bottom">
                    <span class="navbar-text text-monospace text-dark">&copy: Wszelkie prawa zastrzeżone</span>
                </nav>
            </div>
            <div class="content-wrapper">
                <div class="content h-25 mw-full mt-70">

                    <div class="card float-left shadow">
                        <h2 class="card-title">Nasze pizze</h2>
                        <p>Zobacz naszą ofertę</p>
                        <img src="img/pizza.jpg" class="img-fluid" alt="pizza"/>
                        <div class=" position-absolute right-0 m-15">
                            <a href="#"><button class="btn btn-primary">Zobacz ofertę</button></a>
                        </div>
                    </div>
                </div>
                <div class="mt-50">
                    <div class="card float-left shadow ml-50">
                        <h2 class="card-title">Promocje</h2>
                        <img src="img/pizza-promotion.png" class="img-fluid" alt="pizza"/>
                        <div class=" position-absolute right-0 m-15">
                            <a href="#"><button class="btn btn-primary">Sprawdź</button></a>
                        </div>
                    </div>

                    <div class="mt-50">
                    <div class="card float-left shadow ml-20">
                        <h2 class="card-title">Kontakt</h2>
                        <img src="img/pizza-phone.jpg" class="img-fluid" alt="pizza"/>
                        <div class=" position-absolute right-0 m-15">
                            <a href="#"><button class="btn btn-primary">Zadzwoń</button></a>
                        </div>
                    </div>
                
            </div>
    </body>
</html>