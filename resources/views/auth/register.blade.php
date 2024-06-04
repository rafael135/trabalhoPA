@extends("layouts.layoutAuth")

@section("content")
<div class="containercadastro" id="autenticacao">
    <div class="register-image" id="autenticacao">
            <img src="{{Vite::asset("resources/img/Mobile login-pana.png")}}" alt="" />
    </div>
        <div class="formcadastro" id="autenticacao">
            <form action="{{ route("registerAction") }}" method="POST">
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

                    <div class="input-box">
                        <select class="w-full" id="state" name="state" placeholder="UF" required>
                            <option value="" selected>Selecione seu Estado</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>
                </div>
                

                <div class="register-button" id="autenticacao">
                    <button>Registre-se</button>
                </div>
            </form>
        </div>
    </div>
@endsection