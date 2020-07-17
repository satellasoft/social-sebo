{% extends 'partials/body.twig.php' %}

{% block title %}Alterar senha{% endblock %}

{% block body %}

<div class="center">

    <div style="max-width:500px">
        <h1>Alterar senha</h1>
        <div class="box">
            <form action="{{BASE}}login/updatePassword" method="post" id="frmAlterarSenha" onsubmit="return validarSenha();">
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
                    <input type="submit" value="Alterar" class="btn btn-success ml-3">
                </div>
            </form>
        </div>
    </div>
</div>

{% endblock %}

{% block scripts %}
<script src="{{BASE}}assets/js/usuario.min.js"></script>
{% endblock %}