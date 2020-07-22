{% extends 'partials/body.twig.php' %}

{% block title %}Nova categoria{% endblock %}

{% block body %}
<div class="center">
    <h1>Nova categoria</h1>

    <a href="{{BASE}}categoria/lista" class="btn btn-secondary btn-sm">Voltar</a>

    <hr>

    <div class="box">
        <form action="{{BASE}}categoria/insert" method="post" id="frmCadastro" onsubmit="return validarCadastro(false);">
            <div class="row">
                <div class="col-md-6">
                    <label for="txtNome">Nome</label>
                    <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Comédia romântica" autofocus>
                </div>

                <div class="col-md-6">
                    <label for="txtSlug">Slug</label>
                    <input type="text" class="form-control" id="txtSlug" name="txtSlug" placeholder="comedia-romantica">
                </div>
            </div>

            <div id="dvAlert" class="mt-3">
                <div class="alert alert-info">Preencha todos os campos...</div>
            </div>

            <div class="mt-3 text-right">
                <input type="submit" value="Cadastrar" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
{% endblock %}

{% block scripts %}
<script src="{{BASE}}assets/js/categoria.min.js"></script>
{% endblock %}