{% extends 'partials/body.twig.php' %}

{% block title %}{{livro.titulo}}{% endblock %}

{% block body %}

<div class="center">
    <div class="row">
        <div class="col-md-3">
            {% if livro.thumb != null %}
            <img src="{{HOST}}resources/thumb/{{livro.thumb}}" alt="{{livro.titulo}}" title="{{livro.titulo}}" class="w-100">
            {% else %}
            <img src="{{HOST}}assets/img/thumb.jpg" alt="{{livro.titulo}}" title="{{livro.titulo}}" class="w-100">
            {%  endif%}

            <h3><span class="font-weight-bold">preço: </span> R$ {{livro.valor}}</h3>
        </div>

        <div class="col-md-9">
            <h1>{{livro.titulo}}</h1>

            <p>
                <span class="font-weight-bold">Publicado por:</span> {{livro.usuario.nome}}
                <span class="font-weight-bold">Data da publicação:</span> {{livro.dataCadastro | date(DATE_TIME)}}
            </p>

            <hr>

            <div>
                {{livro.sinopse | raw}}
            </div>

            <hr>

            <!--Comentários-->

            <div>
                <input type="hidden" id="txtId" value="{{livro.id}}">
                <!---FORM-->
                {% if userName != null %}
                <div>
                    <form method="post" id="frmComentario">
                        <label for="txtComentario">Comentário</label>

                        <textarea onkeyup="countCharacters(this, 'spCaracteres', 500);" id="txtComentario" class="form-control" rows="3" maxlength="500" placeholder="Insira o seu comentário"></textarea>

                        <div id="dvAlert" class="mt-3 mb-3">
                            <div class="alert alert-info">Informe um comentário entre 10 a 500 caracteres.</div>
                        </div>

                        <div class="text-right">
                            <span style="float:left" class="mt-3"> <span id="spCaracteres" class="font-weight-bold">500</span> caracteres restantes</span>
                            <button class="btn btn-success mt-3" type="submit" id='btnComentar'>Comentar</button>
                        </div>
                    </form>
                </div>
                {% endif %}
                <!---END FORM-->

                <!---COMMENTS-->
                <div id="dvComentarios"></div>
                <!---END COMMENTS-->

            </div>
        </div>

    </div>

</div>
{% endblock %}

{% block scripts %}
<script src="{{BASE}}vendor/jquery/jquery-3.5.1.min.js"></script>
<script src="{{BASE}}assets/js/comentario.min.js"></script>
{% endblock %}