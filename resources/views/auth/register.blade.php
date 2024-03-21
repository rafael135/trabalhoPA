@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="form-image">
            <img src="{{Vite::asset("resources/img/bg1.png")}}" alt="" />
        </div>
        <div class="form">
            <form action="#">
                <div class="form-header">
                    <div class="title">
                        <h1>Faça seu login</h1>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="firstname">Usuario</label>
                        <input id="firstname" type="text" name="firstname" placeholder="Usuario" required>
                    </div>

                    <div class="input-box">
                        <label for="password">Senha</label>
                        <input id="password" type="password" name="password" placeholder="Digite sua senha" required>
                    </div>
                </div>

                <div class="continue-button">
                    <button><a href="#">Continuar</a> </button>
                </div>
            </form>
        </div>
    </div>
@endsection
