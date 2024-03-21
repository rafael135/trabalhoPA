<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Trabalho PA</title>

    <!-- Arquivos são carregados através do Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


</head>

<body>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <img src="{{ Vite::asset("resources/img/logo2.png") }}" alt="" class="logo">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon "></span>
            </button>
            <div class="collapse navbar-collapse nav justify-content-end col px-md-5" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="#">login</a>
                    <a class="nav-link" href="#">Sobre</a>
                    <a class="nav-link" href="#">Contato</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar -->
