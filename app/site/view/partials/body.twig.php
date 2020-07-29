<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{% block title %}{% endblock %} - Social Sebo</title>
    <link rel="stylesheet" href="{{BASE}}vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{BASE}}assets/css/style.css">
    <link rel="shortcut icon" href="{{BASE}}assets/img/favicon.ico">
</head>

<body>

    {% include 'partials/header.twig.php' %}

    {% block body %}{% endblock %}

    <br>

    {% include 'partials/footer.twig.php' %}

    <input type="hidden" id="txtBase" value="{{BASE}}">
    <script src="{{BASE}}assets/js/script.min.js"></script>
    {% block scripts %}{% endblock %}
</body>

</html>