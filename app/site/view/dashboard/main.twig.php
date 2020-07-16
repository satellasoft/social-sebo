{% extends 'partials/body.twig.php' %}

{% block title %}DashBoard{% endblock %}

{% block body %}

<div class="center">
    <h1>DashBoard</h1>
    <a href="#" class="btn btn-info">Categoria</a>
    <a href="#" class="btn btn-primary">Novo livro</a>
    <a href="{{BASE}}login/logout" class="btn btn-warning" onclick="return confirm('Deseja realmente sair?');">Sair</a>
</div>
{% endblock %}