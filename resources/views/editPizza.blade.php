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
                
                if(confirm("Czy na pewno chcesz usunąć pizze?")){
                    location="deletePizza";
                }
            }
        </script>
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
                
                <div class="mt-50 d-flex flex-column h-full">
                    <div class="content d-flex flex-column">
                        <h1 class="content-title ml-5 font-size-36">Edytuj pizze</h1>

                        <div class="d-flex">

                            <form action="getSelectedPizza" method="get" class="mr-10">
                                <select name="pizzaName">
                                    <option value="" disabled selected>Wybierz</option>
                                    @foreach($pizzaName as $name)
                                    <option value="{{$name->Nazwa_pizzy}}">{{$name->Nazwa_pizzy}}</option>
                                    @endforeach
                                </select>

                                <input type="submit" class="btn btn-primary" value="Wybierz">
                            </form>

                            <form action="deletePizza" method="get">
                                <select name="pizzaName">
                                    <option value="" disabled selected>Wybierz</option>
                                    @foreach($pizzaName as $name)
                                    <option value="{{$name->Nazwa_pizzy}}">{{$name->Nazwa_pizzy}}</option>
                                    @endforeach
                                </select>
                                
                                <label for="comfirm">Potiwerdź usunięcie</label>
                                <input type="checkbox" name="confirm" id="confirm">
                                <input type="submit" class="btn btn-primary" value="Usuń">
                            </form>
                        </div>

                        <div class="d-flex justify-content-around">
                            @isset($pizzaData)
                                <div class="card w-400 shadow text-center">
                                <h2 class="content-title">Pizza</h2>
                                    @foreach($pizzaData as $pizza)
                                    <form action="editPizzaData" method="get">
                                        <div class="form-row row-eq-spacing-sm">
                                            <div class="col-sm">
                                                <input type="hidden" id="pizza-id" name="pizzaID" value="{{$pizza->ID}}" >
                                            </div>
                                        </div>
                                        <div class="form-row row-eq-spacing-sm">
                                            <div class="col-sm">
                                                <label for="pizzaName">Nazwa pizzy</label>
                                                <input type="text" name="pizzaName" id="pizzaName" value="{{$pizza->Nazwa_pizzy}}"/>
                                            </div>
                                        </div>

                                        <div class="form-row row-eq-spacing-sm">
                                            <div class="col-sm">
                                                <label for="ingrids">Składniki</label>
                                                <textarea name="ingrids" id="ingrids" rows="3" cols="45">{{$pizza->Skladniki}}</textarea>
                                                </div>
                                        </div>

                                        <div class="form-row row-eq-spacing-sm">
                                            <div class="col-sm">
                                                <label for="price">Cena</label>
                                                <input type="text" name="price" id="price" value="{{$pizza->Cena}}"/>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary " value="Zapisz">
                                    </form>
                                    @endforeach

                                    @if($errors->any())<div class="mt-10"><b>@foreach($errors->all() as $err) <li>{{$err}}</li> @endforeach</b></div>@endif
                                </div>
                            @endif

                            <div class="card w-400 shadow text-center">
                                <h2 class="content-title">Dodaj pizze</h2>

                                <form action="addPizza" method="get">
                                        <div class="form-row row-eq-spacing-sm">
                                            <div class="col-sm">
                                                <label for="addPizzaName" class="required">Nazwa pizzy</label>
                                                <input type="text" name="pizzaName" id="addPizzaName"/>
                                            </div>
                                        </div>

                                        <div class="form-row row-eq-spacing-sm">
                                            <div class="col-sm">
                                                <label for="addIngrids" class="required">Składniki</label>
                                                <textarea name="ingrids" id="addIngrids" rows="3" cols="45"></textarea>
                                                </div>
                                        </div>

                                        <div class="form-row row-eq-spacing-sm">
                                            <div class="col-sm">
                                                <label for="addPrice" class="required">Cena</label>
                                                <input type="text" name="price" id="addPrice"/>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary " value="Dodaj">
                                    </form>

                                    @if($errors->any())<div class="mt-10"><b>@foreach($errors->all() as $err) <li>{{$err}}</li> @endforeach</b></div>@endif
                            </div>
                        </div>
                    </div>

                </div>

                
            </div>

                <div class="d-flex position-fixed bottom-0 w-full">
                    <footer class="pl-20 bg-dark-light w-full text-white font-weight-semi-bold">
                        <span>&copy: Wszelkie prawa zastrzeżone</span>
                    </footer>
                </div>

            
                
    </body>
</html>