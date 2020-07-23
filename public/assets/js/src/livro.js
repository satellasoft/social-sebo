'use strict'

function validarCadastro(validarId) {
    getById('dvAlert').innerHTML = '';

    if (validarId && getValueById('txtId') <= 0) {
        getById('dvAlert').innerHTML = '<div class="alert alert-warning">ID inválido.</div>';
        return false;
    }

    if (getValueById('txtTitulo').trim().length < 2) {
        getById('dvAlert').innerHTML += '<div class="alert alert-warning">Informe um título válido.</div>';
        return false;
    }

    if (getValueById('txtSlug').trim().length < 2) {
        getById('dvAlert').innerHTML += '<div class="alert alert-warning">Informe um slug válido.</div>';
        return false;
    }

    if (getValueById('txtValor').trim().length < 2) {
        getById('dvAlert').innerHTML += '<div class="alert alert-warning">Informe o valor.</div>';
        return false;
    }

    if (getValueById('slStatus') < 1 || getValueById('slStatus') > 2) {
        getById('dvAlert').innerHTML += '<div class="alert alert-warning">Status inválido.</div>';
        return false;
    }

    if (getValueById('slCategoria') < 1 || getValueById('slCategoria') == null) {
        getById('dvAlert').innerHTML += '<div class="alert alert-warning">categoria inválida.</div>';
        return false;
    }

    var sinopse = CKEDITOR.instances['txtSinopse'].getData()

    if (sinopse.length < 10) {
        getById('dvAlert').innerHTML += '<div class="alert alert-warning">Sinopse inválida.</div>';
        return false;
    }

    return true;
}

function validarThumb() {

    if (getById('flThumb').files.length == 0) {
        getById('dvAlert').innerHTML = '<div class="alert alert-warning">Selecione uma imagem.</div>';
        return false;
    }

    return true;
}