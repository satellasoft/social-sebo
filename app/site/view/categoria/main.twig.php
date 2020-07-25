{% extends 'partials/body.twig.php' %}

{% block title %}Categorias{% endblock %}

{% block body %}
<div class="center">

    <div style="max-width:500px">
        <h1>Categorias</h1>
        <div class="box text-center">
            {% for categoria in categorias %}
            <p><a href="{{BASE}}categoria/ver/{{categoria.slug}}" style="font-size: 1.2em;">{{categoria.nome}}</a></p>
            {% endfor %}
        </div>
    </div>
    
</div>
{% endblock %}