{% extends 'partials/body.twig.php' %}

{% block title %}

{{title}}

{% endblock %}

{% block body %}
<div class="center mt-3">
    <h1>{{title}}</h1>

    <h2>{{ message | raw }}</h2>

    <h4>Código de resposta: <span class="font-weight-bold">{{httpCode}}</span></h4>
</div>
{% endblock %}