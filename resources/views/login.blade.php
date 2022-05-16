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
                            <a href="{{ url('/') }}#dostawa" class="nav-link">Dostawa</a>
                        </li>
                        
                        <li class="new-item active mt-auto mb-auto">
                            <a href="{{ url('/') }}#kontakt" class="nav-link">Kontakt</a>
                        </li>
                        
                    </ul>
                    
                    <button onclick="location='login'" class="btn btn-primary text-white ml-auto mr-15">
                        <i class="icon-login"> Zaloguj się</i>
                    </button></a>

                </nav>

                
            </div>

            <div class="content-wrapper">
                
                <div class="d-flex h-full w-full justify-content-center">

                        <div class="card bg-white h-550 mt-120 shadow">

                            <form action="loginSession" method="get">
                                <h2 class="content-title">Logowanie</h2>
                                
                                <div class="form-row row-eq-spacing-sm">
                                    <div class="col-sm">
                                        <label for="login-log" class="required">Login</label>
                                        <input type="text" class="form-control" id="login" name="login" placeholder="Login" required="required">
                                    </div>
                                </div>
                                
                                <div class="form-row row-eq-spacing-sm">
                                    <div class="col-sm">
                                        <label for="password-log" class="required">Hasło</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required">
                                    </div>
                                </div>
                                Nie masz konta? <a href="{{ url('/register')}}"> Zarejestruj się </a>
                                <div class="text-right">
                                    <input type="submit" class="btn btn-primary" value="Zaloguj">
                                </div>
                                
                                @if($errors->any())<div class="mt-10"><b>@foreach($errors->all() as $err) <li>{{$err}}</li> @endforeach</b></div>@endif
                            </form>
                        </div>
                    
                </div>

                <div class="d-flex">
                    <footer class="pl-20 bg-dark-light w-full text-white font-weight-semi-bold">
                        <span>&copy: Wszelkie prawa zastrzeżone</span>
                    </footer>
                </div>

            
                
    </body>
</html>