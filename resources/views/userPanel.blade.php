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


        <script type="text/javascript">

            function deleteConfirm(){
                
                if(confirm("Czy na pewno chcesz usunąć konto?")){
                    location="deleteAccount";
                }
            }
        </script>
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
                        @if($role == "Admin")<button onclick="location='registerUserByAdmin'" class="btn btn-primary ml-auto mr-15"><i class="icon-user-plus"> Dodaj użytkownika</i></button>@endif

                        @isset($role)<button onclick="location='userPanel'" class="btn btn-primary mr-15"><i class="icon-user"> {{$role}}</i></button>@endif

                        @isset($role)<button onclick="location='myCart'" class="btn btn-primary ml-auto mr-15"><i class="icon-basket"></i></button>@endif

                        @if($role != "Admin") <button onclick="deleteConfirm()" class="btn btn-primary mr-15"><i class="icon-user-times">Usuń konto</i></button>@endif
                        
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

                <div class="d-flex h-full justify-content-around">
                    @foreach($user as $userData)
                    <div class="card mt-100 w-500 h-550 shadow text-center">
                        <form action="editUserData" method="get">
                            <h2 class="content-title">Edytuj dane</h2>

                            <div class="form-row row-eq-spacing-sm">
                                <div class="col-sm">
                                    <label for="name">Imię</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$userData->Imie}}" required="required">
                                </div>
                                <div class="col-sm">
                                    <label for="surname" >Nazwisko</label>
                                    <input type="text" class="form-control" id="surname" name="surname" value="{{$userData->Nazwisko}}" required="required">
                                </div>
                            </div>
                                    
                            <div class="form-row row-eq-spacing-sm">
                                <div class="col-sm">
                                    <label for="streat" >Ulica</label>
                                    <input type="text" class="form-control" id="streat" name="street" value="{{$userData->Ulica}}" required="required">
                                </div>
                                <div class="col-sm">
                                    <label for="hosue" >Nr domu</label>
                                    <input type="text" class="form-control" id="house" name="house" value="{{$userData->Nr_domu}}" required="required">
                                </div>
                                <div class="col-sm">
                                    <label for="flat">Nr mieszkania</label>
                                    <input type="text" class="form-control" id="flat" name="flat" value="{{$userData->Nr_mieszkania}}">
                                </div>
                            </div>

                            <div class="form-row row-eq-spacing-sm">
                                <div class="col-sm">
                                    <label for="town" >Miasto</label>
                                    <input type="text" class="form-control" id="town" name="town" value="{{$userData->Miasto}}" required="required">
                                </div>
                                <div class="col-sm">
                                    <label for="postal" >Kod pocztowy</label>
                                    <input type="text" class="form-control" id="postal" name="postal" value="{{$userData->Kod_pocztowy}}" required="required">
                                </div>
                            </div>

                            <div class="form-row row-eq-spacing-sm">
                                <div class="col-sm">
                                    <label for="login-reg" >Login</label>
                                    <input type="text" class="form-control" id="login-reg" name="login" value="{{$userData->Login}}" required="required">
                                </div>
                            </div>

                            <div class="form-row row-eq-spacing-sm">
                                <div class="col-sm">
                                    <label for="phone" >Nr telefonu</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{$userData->Nr_telefonu}}" value="+48" required="required">
                                </div>
                                <div class="col-sm">
                                    <label for="e-mail" >E-mail</label>
                                    <input type="text" class="form-control" id="e-mail" name="mail"value="{{$userData->Mail}}" required="required">
                                </div>
                            </div>

                            <div class="text-right">
                                <input type="submit" class="btn btn-primary" value="Edytuj">
                            </div>
                        </form>
                    </div>
                    
                    @endforeach
                    <div class="card mt-100 w-300 h-500 shadow text-center">
                        <h2 class="content-title">Zmień hasło</h2>

                        <form action="editUserPassword" method="get">
                            <div class="form-row row-eq-spacing-sm">
                                <label for="new-password" >Nowe hasło</label>
                                <input type="password" class="form-control" id="new-password" name="new-password" placeholder="Nowe hasło"  required="required">
                            </div>
                            <div class="form-row row-eq-spacing-sm">
                                <label for="new-password-2" >Powtórz nowe hasło</label>
                                <input type="password" class="form-control" id="new-password-2" name="new-password-2" placeholder="Powtórz nowe hasło" required="required">
                            </div>

                            <input type="submit" class="btn btn-primary" value="Zmień">
                        
                        </form>
                    </div>
                </div>

                <div class="d-flex position-fixed bottom-0 w-full">
                    <footer class="pl-20 bg-dark-light w-full text-white font-weight-semi-bold">
                        <span>&copy: Wszelkie prawa zastrzeżone xD</span>
                    </footer>
                </div>
            </div>

            
                
    </body>
</html>