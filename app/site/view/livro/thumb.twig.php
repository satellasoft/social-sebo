{% extends 'partials/body.twig.php' %}

{% block title %}Alterar thumb{% endblock %}

{% block body %}
<div class="center">
    <h1>Alterar thumb</h1>

    <a href="{{BASE}}dashboard" class="btn btn-secondary btn-sm">Voltar</a>

    <hr>

    <div class="box">
        <form action="{{BASE}}livro/updateThumb/{{idLivro}}" method="post" id="frmThumb" onsubmit="return validarThumb();" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    {% if thumb != null %}
                    <img src="{{thumb}}" alt="Livro" class="w-100">
                    {% else %}
                    Nenhuma thumb cadastrada
                    {% endif %}
                </div>

                <div class="col-md-6">
                    <label for="flThumb">Thumb</label>
                    <input type="file" class="form-control-file" id="flThumb" name="flThumb">
                </div>
            </div>

            <div id="dvAlert" class="mt-3">
                <div class="alert alert-info">Selecione a thumb</div>
            </div>

            <div class="mt-3 text-right">
                <input type="submit" value="Alterar" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
{% endblock %}

{% block scripts %}
<script src="{{BASE}}assets/js/livro.min.js"></script>
{% endblock %}