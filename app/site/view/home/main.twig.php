{% extends 'partials/body.twig.php' %}

{% block title %}Home{% endblock %}

{% block body %}

<div class="center">
    <h1>Últimos livros</h1>
    <hr>

    {% for livro in livros %}

    <div class="row">
        {% for item in livro %}
        <div class="col-md-3">
            <a href="{{HOST}}livro/ver/{{item.slug}}" title="{{item.titulo}}" aria-label="{{item.titulo}}">
                {% if item.thumb != null %}
                <img src="{{HOST}}resources/thumb/{{item.thumb}}" alt="{{item.titulo}}" title="{{item.titulo}}" class="w-100">
                {% else %}
                <img src="{{HOST}}assets/img/thumb.jpg" alt="{{item.titulo}}" title="{{item.titulo}}" class="w-100">
                {%  endif%}
            </a>

            <p class="text-center" style="font-size:1.2em;"><span class="font-weight-bold">preço: </span> R$ {{item.valor}}</p>
        </div>
        {% endfor %}
    </div>

    {% endfor %}
</div>
{% endblock %}