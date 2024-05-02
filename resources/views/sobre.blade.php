@extends('layouts.layout')

@section('content')

<div>
    <div class=" container-sobre">
        <div class="flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="sobre">
                <img src="{{ Vite::asset('resources/img/Information tab-pana.png') }}"
            </div>
        </div>
    </div>
</div>

<div class=" div px-5 pt-5 my-5 text-center ">
    <h1 class="display-10 fw-bold">Quem Somos ?</h1>
    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-buildings"
        viewBox="0 0 16 16">
        <path
            d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z" />
        <path
            d="M2 11h1v1H2zm2 0h1v1H4zm-2 2h1v1H2zm2 0h1v1H4zm4-4h1v1H8zm2 0h1v1h-1zm-2 2h1v1H8zm2 0h1v1h-1zm2-2h1v1h-1zm0 2h1v1h-1zM8 7h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zM8 5h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zm0-2h1v1h-1z" />
    </svg>
    <div class="col-lg-8 mx-auto">
        <p class="lead mb-5">Somos mais do que uma empresa para controle e monitoramento de consuimo de energia elétrica
            de residências;somos impulsionados pela visào de transformar a maneira como nossos clientes, obtém e
            utilizam energia. Com uma equipe dedicada de profissionais apaixonados, combina expertise técnica com
            compromisso inabalável.</p>
    </div>
      @endsection