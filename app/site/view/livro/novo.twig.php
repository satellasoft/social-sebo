{% extends 'partials/body.twig.php' %}

{% block title %}Novo livro{% endblock %}

{% block body %}
<div class="center">
    <h1>Novo livro</h1>

    <a href="{{BASE}}dashboard" class="btn btn-secondary btn-sm">Voltar</a>

    <hr>

    <div class="box">
        <form action="{{BASE}}livro/insert" method="post" id="frmCadastro" onsubmit="return validarCadastro(false);">
            <div class="row">
                <div class="col-md-6">
                    <label for="txtTitulo">Título</label>
                    <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="Comédia romântica" autofocus>
                </div>

                <div class="col-md-6">
                    <label for="txtSlug">Slug</label>
                    <input type="text" class="form-control" id="txtSlug" name="txtSlug" placeholder="comedia-romantica">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="slStatus">Status</label>
                    <select class="form-control" id="slStatus" name="slStatus">
                        <option value="1">Ativo</option>
                        <option value="2">Oculto</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="slCategoria">Categoria</label>
                    <select class="form-control" id="slCategoria" name="slCategoria">
                        {% for categoria in categorias %}
                        <option value="{{categoria.id}}">{{categoria.nome}}</option>
                        {% endfor %}
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="txtValor">Valor</label>
                    <input type="text" class="form-control" id="txtValor" name="txtValor" placeholder="10,99">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <label for="txtSinopse">Sinopse</label>
                    <textarea name="txtSinopse" id="txtSinopse"></textarea>
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
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script src="{{BASE}}assets/js/livro.min.js"></script>

<script>
    CKEDITOR.replace('txtSinopse');
</script>
{% endblock %}