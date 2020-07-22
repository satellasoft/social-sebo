{% extends 'partials/body.twig.php' %}

{% block title %}Listar categorias{% endblock %}

{% block body %}
<div class="center">
    <h1>Listar categorias</h1>

    <a href="{{BASE}}dashboard/" class="btn btn-secondary btn-sm">Dashboard</a>
    <a href="{{BASE}}categoria/nova" class="btn btn-primary btn-sm">Nova</a>

    <hr>

    <div class="overflow-auto">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Slug</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                {% for categoria in categorias %}
                <tr>
                    <td>{{categoria.nome}}</td>
                    <td>{{categoria.slug}}</td>
                    <td>
                        <a href="{{BASE}}categoria/editar/{{categoria.id}}" class="btn btn-warning btn-sm">Editar</a>
                    </td>
                </tr>
                {% endfor %}
            </tbody>
        </table>
    </div>
</div>
{% endblock %}