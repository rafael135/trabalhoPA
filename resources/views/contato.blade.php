@extends('layouts.layout')

@section('content')
    <div class="container" id="contato">
        <div class="info">
            <div class="titulo">
                <h1>Está com Duvida?</h1>
                <div class="texto">
                <p>
                     • Não esta conseguindo fazer o login
                </p>
                <p>
                     • Teve algum problema dentro do nosso sistema
                </p>
                <p>
                     • Quer tirar alguma duvida
                </p>
                <h4>Nos envie sua mensagem para poder te ajudar</h4>
                </div>
            </div>
        </div>
        <div class="form" id="contato">
            <form>
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name" placeholder="Nome Completo">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="email@exemplo.com">
                </div>
                <div class="form-group">
                    <label for="message">Mensagem</label>
                    <textarea class="form-control" id="message" rows="5"></textarea>
                </div>
                <div class="continue-button" id="contato">
                    <button><a href="#">Enviar</a></button>
                </div>
            </form>
        </div>
    </div>
    <div class="form-image" id="contato">
        <img src="{{ Vite::asset("resources/img/Contact us-amico.png") }}" alt="">
    </div>
@endsection
