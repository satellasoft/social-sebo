'use strict'

$(document).ready(function () {
    getCommentList();
});

function countCharacters(el, target, max) {

    var total = max - el.value.length;

    document.getElementById('spCaracteres').innerText = total;
}

$('#frmComentario').submit(function (event) {

    var obj = {
        id: $('#txtId').val(),
        comentario: $('#txtComentario').val()
    }

    if (!validate(obj)) {
        event.preventDefault();
        return;
    }

    insert(obj);

    event.preventDefault();
});

function validate(obj) {

    if (obj.id <= 0 || obj.id == null) {
        $('#dvAlert').html('<div class="alert alert-warning">ID inválido.</div>');
        return false;
    }

    if (obj.comentario.length < 10 || obj.comentario.length > 500 || obj.comentario == null) {
        $('#dvAlert').html('<div class="alert alert-warning">Comentário inválido.</div>');
        return false;
    }

    return true;
}

function insert(obj) {
    $.ajax({
        url: $('#txtBase').val() + 'comentario/insert/' + obj.id,
        data: obj,
        type: 'POST',
        dataType: 'JSON',
        beforeSend: function () {
            $('#btnComentar').attr('disabled', 'disabled');
            $('#dvAlert').html('<div class="alert alert-info">Aguarde, inserindo...</div>');
        },
        complete: function () {
            $('#btnComentar').removeAttr('disabled');
        },
        success: function (data) {

            if (typeof data.code != 'undefined' && data.code == 1) {
                $('#dvAlert').html('<div class="alert alert-success">Comentário enviado com sucesso.</div>');
                $('#txtComentario').val('');
                getCommentList();
                return;
            }

            $('#dvAlert').html('<div class="alert alert-warning">' + data.msg + '</div>');
        },
        error: function (error) {
            $('#dvAlert').html('<div class="alert alert-danger">Houve um erro ao tentar inserir, tente novamente mais tarde.</div>');

            console.log(error);
        }
    });
}

function getCommentList() {

    $.ajax({
        url: $('#txtBase').val() + 'comentario/getLivro/' + $('#txtId').val(),
        data: {},
        type: 'GET',
        dataType: 'JSON',
        success: function (data) {
            createList(data);
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function createList(data) {
    var divComentarios = document.getElementById('dvComentarios');
    divComentarios.innerHTML = '';

    for (var i = 0; i < data.length; i++) {
        var div = document.createElement('div');
        div.className = 'div-comentario';

        var pNome = document.createElement('p');
        pNome.className = 'nome-comentario';
        pNome.innerText = data[i].usuarioNome;

        div.appendChild(pNome);

        var pComentario = document.createElement('p');
        pComentario.innerText = data[i].comentario;

        div.appendChild(pComentario);

        divComentarios.appendChild(div);
    }

}