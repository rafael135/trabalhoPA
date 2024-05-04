@extends("layouts.layoutAuth")

@section("content")
<div class="containercadastro" id="autenticacao">
    <div class="register-image" id="autenticacao">
            <img src="{{Vite::asset("resources/img/Mobile login-pana.png")}}" alt="" />
    </div>
        <div class="formcadastro" id="autenticacao">
            <form action="{{ route("registerAction"); }}" method="POST">
                @csrf
                <div class="form-header-cadastro" id="autenticacao">
                    <div class="title">
                        <h1>Registre-se</h1>
                    </div>
                </div>
                <p>Ao criar um contrato na Wattsweb você terá acesso a nossa plataforma. Estamos torcendo pelo seu sucesso ;D</p>
                <div class="input-group">
                    <div class="input-box">
                        <input id="name" type="text" name="name" placeholder="Nome" required>
                    </div>

                    <div class="input-box">
                        <input id="email" type="email" name="email" placeholder="Digite seu email" required>
                    </div>

                    <div class="input-box">
                        <input id="password" type="password" name="password" placeholder="Digite sua senha" required>
                    </div>

                    <div class="input-box">
                        <input id="passwordConfirm" type="password" name="passwordConfirm" placeholder="Repita a sua senha" required>
                    </div>
                </div>
                

                <div class="register-button" id="autenticacao">
                    <button>Registre-se</button>
                </div>
            </form>
        </div>
    </div>
@endsection