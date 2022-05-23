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
                <nav class="navbar justify-content-between">
                    
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
                            @isset($role)<button onclick="location='userPanel'" class="btn btn-primary mr-15">{{$role}}</button>@endif
                                
                            @if(isset($role))<button onclick="location='logout'" class="btn btn-primary text-white ml-auto mr-15">
                                <i class="icon-login"> Wyloguj się</i>
                            </button>@else<button onclick="location='login'" class="btn btn-primary text-white ml-auto mr-15">
                                <i class="icon-login"> Zaloguj się</i>
                            </button>@endif
                        </div>
                    
                </nav>

                
            </div>

            <div class="content-wrapper">
            @if($errors->any())<div class="card mt-50"><b>@foreach($errors->all() as $err) <li>{{$err}}</li> @endforeach</b></div>@endif
                <div class="d-flex h-full justify-content-center">   
                    
                        <div class="card bg-white w-600 h-700 mt-50 shadow">

                            <form action="registerUser" method="get">
                                <h2 class="content-title">Rejestracja</h2>

                                <div class="form-row row-eq-spacing-sm">
                                    <div class="col-sm">
                                        <label for="name" class="required">Imię</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Imię" required="required">
                                    </div>
                                    <div class="col-sm">
                                        <label for="surname" class="required">Nazwisko</label>
                                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Nazwisko" required="required">
                                    </div>
                                </div>
                                
                                <div class="form-row row-eq-spacing-sm">
                                    <div class="col-sm">
                                        <label for="streat" class="required">Ulica</label>
                                        <input type="text" class="form-control" id="streat" name="street" placeholder="Ulica" required="required">
                                    </div>
                                    <div class="col-sm">
                                        <label for="hosue" class="required">Nr domu</label>
                                        <input type="text" class="form-control" id="house" name="house" placeholder="Nr domu" required="required">
                                    </div>
                                    <div class="col-sm">
                                        <label for="flat">Nr mieszkania</label>
                                        <input type="text" class="form-control" id="flat" name="flat" placeholder="Nr mieszkania">
                                    </div>
                                </div>

                                <div class="form-row row-eq-spacing-sm">
                                    <div class="col-sm">
                                        <label for="town" class="required">Miasto</label>
                                        <input type="text" class="form-control" id="town" name="town" placeholder="Miasto" required="required">
                                    </div>
                                    <div class="col-sm">
                                        <label for="postal" class="required">Kod pocztowy</label>
                                        <input type="text" class="form-control" id="postal" name="postal" placeholder="Kod pocztowy" required="required">
                                    </div>
                                </div>

                                <div class="form-row row-eq-spacing-sm">
                                    <div class="col-sm">
                                        <label for="login-reg" class="required">Login</label>
                                        <input type="text" class="form-control" id="login-reg" name="login" placeholder="Login" required="required">
                                    </div>
                                    <div class="col-sm">
                                        <label for="password-reg" class="required">Hasło</label>
                                        <input type="password" class="form-control" id="password-reg" name="password" placeholder="Password" required="required">
                                    </div>
                                </div>

                                <div class="form-row row-eq-spacing-sm">
                                    <div class="col-sm">
                                        <label for="phone" class="required">Nr telefonu</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Nr telefonu" value="+48" required="required">
                                    </div>
                                    <div class="col-sm">
                                        <label for="e-mail" class="required">E-mail</label>
                                        <input type="text" class="form-control" id="e-mail" name="mail" placeholder="E-mail" required="required">
                                    </div>
                                </div>
                                    
                                <div class="form-row row-eq-spacing-sm">
                                    <div class="col-sm">
                                        <label for="role" class="required">Rola</label>
                                        <select name="role" id="role">
                                            <option value="Admin">Admin</option>
                                            <option value="Klient">Klient</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <input type="submit" class="btn btn-primary" value="Zarejestruj">
                                </div>
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