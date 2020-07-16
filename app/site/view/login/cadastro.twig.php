{% extends 'partials/body.twig.php' %}

{% block title %}Cadastrar{% endblock %}

{% block body %}

<div class="center">

    <div style="max-width:500px">
        <h1>Cadastro</h1>
        <div class="box">
            <form action="{{BASE}}login/insert" method="post" id="frmCadastro" onsubmit="return validarCadastro();">
                <div>
                    <label for="txtNome">Nome</label>
                    <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Joana Joaquina José" autofocus>
                </div>

                <div class="mt-3">
                    <label for="txtEmail">E-mail</label>
                    <input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="email@domain.com">
                </div>

                <div class="mt-3">
                    <label for="txtSenha">Senha <span class="small-font">(minímo 7 caracteres)</span></label>
                    <input type="password" class="form-control" id="txtSenha" name="txtSenha" placeholder="*********">
                </div>

                <div class="mt-3">
                    <label for="txtSenhaConfirmar">Confirmar Senha</label>
                    <input type="password" class="form-control" id="txtSenhaConfirmar" name="txtSenhaConfirmar" placeholder="*********">
                </div>

                <div id="dvAlert" class="mt-3">
                    <div class="alert alert-info">Preencha todos os campos...</div>
                </div>

                <div class="mt-3 text-right">
                    Li e estou de acordo com os <a href="#">termos de uso</a>.
                    <input type="submit" value="Cadastrar" class="btn btn-success ml-3">
                </div>
            </form>
        </div>
    </div>
</div>

{% endblock %}

{% block scripts %}
<script src="{{BASE}}assets/js/usuario.min.js"></script>
{% endblock %}