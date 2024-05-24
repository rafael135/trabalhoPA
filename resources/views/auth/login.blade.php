@extends('layouts.layoutAuth')

@section('content')
    <div class="container" id="autenticacao">
        <div class="form-image" id="autenticacao">
            <img src="{{Vite::asset("resources/img/bg1.png")}}" alt="" />
        </div>
        <div class="form" id="autenticacao">
            <form action="{{ route("loginAction") }}" method="POST">
                @csrf
                <div class="form-header" id="autenticacao">
                    <div class="title">
                        <h1>Faça seu login</h1>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="email">Email</label>
                        <input id="email" type="text" name="email" placeholder="Email" required>
                    </div>

                    <div class="input-box">
                        <label for="password">Senha</label>
                        <input id="password" type="password" name="password" placeholder="Digite sua senha" required>
                    </div>
                </div>

                <div class="continue-button" id="autenticacao">
                    <button><a href="#">Continuar</a> </button>
                </div>
            </form>
        </div>
    </div>
@endsection
