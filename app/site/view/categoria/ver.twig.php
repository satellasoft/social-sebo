{% extends 'partials/body.twig.php' %}

{% block title %}{{categoria.nome}}{% endblock %}

{% block body %}
<div class="center">

    <h1>{{categoria.nome}}</h1>

    {% for livro in livros %}
    <div class="row mb-3">
        {% for item in livro %}
        <div class="col-md-6">
            <a href="{{BASE}}livro/ver/{{item.slug}}" title="{{item.titulo}}" aria-label="{{item.titulo}}">
                {% if item.thumb != null %}
                <img src="{{HOST}}resources/thumb/{{item.thumb}}" alt="{{item.titulo}}" class="w-100">
                {% else %}
                <img src="{{HOST}}assets/img/thumb.jpg" alt="{{item.titulo}}" class="w-100">
                {%  endif%}
            </a>
        </div>
        {% endfor %}
    </div>
    {% endfor %}

</div>
{% endblock %}