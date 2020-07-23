{% extends 'partials/body.twig.php' %}

{% block title %}DashBoard{% endblock %}

{% block body %}

<div class="center">
    <h1>DashBoard</h1>
    <a href="{{BASE}}categoria/lista" class="btn btn-info">Categoria</a>
    <a href="{{BASE}}livro/novo" class="btn btn-primary">Novo livro</a>
    <a href="{{BASE}}login/logout" class="btn btn-warning" onclick="return confirm('Deseja realmente sair?');">Sair</a>
    <hr>

    <div class="overflow-auto">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Categoria</th>
                    <th>Data de cadastro</th>
                </tr>
            </thead>

            <tbody>
                {% for livro in livros %}
                <tr>
                    <td>{{livro.titulo}}</td>
                    <td>
                        <a href="{{BASE}}livro/ver/{{livro.slug}}" target="_blank">{{livro.slug}}</a>
                    </td>
                    <td>{{livro.status == 1 ? 'Ativo' : 'Oculto'}}</td>

                    <td>{{livro.categoria.nome}}</td>
                    <td>{{livro.dataCadastro | date(DATE_TIME)}}</td>
                    <td>
                        <a href="{{BASE}}livro/thumb/{{livro.id}}" class="btn btn-primary btn-sm mr-2">Thumb</a>
                        <a href="{{BASE}}livro/editar/{{livro.id}}" class="btn btn-warning btn-sm">Editar</a>
                    </td>
                </tr>
                {% endfor %}
            </tbody>
        </table>
    </div>

</div>
{% endblock %}