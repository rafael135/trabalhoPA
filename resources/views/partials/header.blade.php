<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Trabalho PA</title>

    <script src=""></script>

    <link href="{{ Vite::asset('resources/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Arquivos são carregados através do Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @routes
</head>

<body>
    <!-- ********navbar******** -->
    <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark navrosponse">
        <div class="container-fluid">
            <a href="{{ route("home") }}"><img src="{{ Vite::asset('resources/img/logo2.png') }}" alt="" class="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon "></span>
            </button>
            <div class="collapse navbar-collapse nav justify-content-end col px-md-5" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="{{ route('contato') }}">Contato</a>
                    <a class="nav-link" href="{{ route('sobre') }}">Sobre</a>

                    @if($loggedUser == null)
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                        <a class="nav-link" href="{{ route('register') }}">Registrar</a>
                    @else
                        <a class="nav-link" href="{{ route('logout') }}">Sair</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    <!-- ********navbar******** -->
