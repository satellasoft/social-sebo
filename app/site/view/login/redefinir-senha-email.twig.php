{% extends 'partials/body.twig.php' %}

{% block title %}Recuperar senha{% endblock %}

{% block body %}

<div class="center">
    <div style="max-width:500px">
        <h1>Recuperar senha</h1>
        <div class="box">
            <p>Por favor, digite seu e-mail cadastrado abaixo para enviarmos instruções para o seu e-mail de como redefinir sua senha.</p>
            <form action="{{BASE}}login/recuperarSenhaEmail" method="post" id="frmRecuperarSenha" onsubmit="return validarEmail();">
                <div class="mt-3">
                    <label for="txtSenha">Senha </label>
                    <input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="joelma@domain.com">
                </div>

                <div id="dvAlert" class="mt-3">
                    <div class="alert alert-info">Preencha todos os campos...</div>
                </div>

                <div class="mt-3 text-right">
                    <input type="submit" value="Enviar" class="btn btn-success ml-3">
                </div>
            </form>
        </div>
    </div>
</div>
{% endblock %}

{% block scripts %}
<script src="{{BASE}}assets/js/usuario.min.js"></script>
{% endblock %}