{% extends 'partials/body.twig.php' %}

{% block title %}Editar livro{% endblock %}

{% block body %}
<div class="center">
    <h1>Editar livro</h1>

    <a href="{{BASE}}dashboard" class="btn btn-secondary btn-sm">Voltar</a>
    <a href="{{BASE}}livro/thumb/{{livro.id}}" class="btn btn-primary btn-sm mr-2">Thumb</a>

    <hr>

    <div class="box">
        <form action="{{BASE}}livro/update/{{livro.id}}" method="post" id="frmCadastro" onsubmit="return validarCadastro(true);">
            <div class="row">
                <div class="col-md-6">
                    <label for="txtTitulo">Título</label>
                    <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="Comédia romântica" value="{{livro.titulo}}" autofocus>
                    <input type="hidden" id="txtId" value="{{livro.id}}">
                </div>

                <div class="col-md-6">
                    <label for="txtSlug">Slug</label>
                    <input type="text" class="form-control" id="txtSlug" name="txtSlug" placeholder="comedia-romantica" value="{{livro.slug}}">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="slStatus">Status</label>
                    <select class="form-control" id="slStatus" name="slStatus">
                        <option value="1" {{livro.status == 1 ? 'selected' : '' }}>Ativo</option>
                        <option value="2" {{livro.status == 2 ? 'selected' : '' }}>Oculto</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="slCategoria">Categoria</label>
                    <select class="form-control" id="slCategoria" name="slCategoria">
                        {% for categoria in categorias %}
                        <option value="{{categoria.id}}" {{categoria.id == livro.categoria.id ? 'selected' : ''}}>{{categoria.nome}}</option>
                        {% endfor %}
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="txtValor">Valor</label>
                    <input type="text" class="form-control" id="txtValor" name="txtValor" placeholder="10,99" value="{{livro.valor}}">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <label for="txtSinopse">Sinopse</label>
                    <textarea name="txtSinopse" id="txtSinopse">{{livro.sinopse | raw}}</textarea>
                </div>
            </div>

            <div id="dvAlert" class="mt-3">
                <div class="alert alert-info">Preencha todos os campos...</div>
            </div>

            <div class="mt-3 text-right">
                <input type="submit" value="Alterar" class="btn btn-success">
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