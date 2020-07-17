{% extends 'partials/body.twig.php' %}

{% block title %}Editar{% endblock %}

{% block body %}

<div class="center">

    <div style="max-width:500px">
        <h1>Editar</h1>
        <div class="box">
            <form action="{{BASE}}login/update" method="post" id="frmEditar" onsubmit="return validarEditar();">
                <div>
                    <label for="txtNome">Nome</label>
                    <input type="text" class="form-control" value="{{usuario.nome}}" id="txtNome" name="txtNome" placeholder="Joana Joaquina José" autofocus>
                </div>

                <div class="mt-3">
                    <label for="txtEmail">E-mail</label>
                    <input type="text" class="form-control" value="{{usuario.email}}" id="txtEmail" name="txtEmail" placeholder="email@domain.com" readonly>
                </div>

                <div id="dvAlert" class="mt-3">
                    <div class="alert alert-info">Preencha todos os campos...</div>
                </div>

                <div class="mt-3 text-right">
                    Li e estou de acordo com os <a href="#">termos de uso</a>.
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