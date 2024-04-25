@extends("layouts.layoutAuth")

@section("content")
<div class="containercadastro" id="autenticacao">
        <div class="formcadastro" id="autenticacao">
            <form action="{{ route("loginAction"); }}" method="POST">
                @csrf
                <div class="form-header-cadastro" id="autenticacao">
                    <div class="title">
                        <h1>Cadastre-se</h1>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="usuario">Usuario</label>
                        <input id="usuario" type="text" name="usuario" placeholder="Usuario" required>
                    </div>

                    <div class="input-box">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" placeholder="Digite seu email" required>
                    </div>

                    <div class="input-box">
                        <label for="password">Senha</label>
                        <input id="password" type="password" name="password" placeholder="Digite sua senha" required>
                    </div>
                </div>

                <div class="continue-button" id="autenticacao">
                    <button><a href="#">Cadastrar</a> </button>
                </div>
            </form>
        </div>
    </div>
@endsection