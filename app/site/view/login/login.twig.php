{% extends 'partials/body.twig.php' %}

{% block title %}Login{% endblock %}

{% block body %}

<div class="center">

    <div style="max-width:500px">
        <h1>Login</h1>
        <div class="box">
            <form action="{{BASE}}login/auth" method="post" id="frmLogin" onsubmit="return validarLogin();">
                <div>
                    <label for="txtEmail">E-mail</label>
                    <input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="email@domain.com" autofocus>
                </div>

                <div class="mt-3">
                    <label for="txtSenha">Senha</label>
                    <input type="password" class="form-control" id="txtSenha" name="txtSenha" placeholder="*********">
                </div>

                <div id="dvAlert" class="mt-3">
                    <div class="alert alert-info">Preencha todos os campos...</div>
                </div>

                <div class="mt-3 text-right">
                    <a href="{{BASE}}login/recuperar" class="mr-3">Recuperar Senha</a>
                    <a href="{{BASE}}login/cadastrar" class="mr-3">Cadastrar</a>

                    <input type="submit" value="Entrar" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

{% endblock %}

{% block scripts %}
<script src="{{BASE}}assets/js/usuario.min.js"></script>
{% endblock %}