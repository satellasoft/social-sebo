'use strict'

function validarCadastro(validarId) {
    getById('dvAlert').innerHTML = '';

    if (validarId && getValueById('txtId') <= 0) {
        getById('dvAlert').innerHTML = '<div class="alert alert-warning">ID inválido.</div>';
        return false;
    }

    if (getValueById('txtNome').trim().length < 2) {
        getById('dvAlert').innerHTML += '<div class="alert alert-warning">Informe um nome válido.</div>';
        return false;
    }

    if (getValueById('txtSlug').trim().length < 2) {
        getById('dvAlert').innerHTML += '<div class="alert alert-warning">Informe um slug válido.</div>';
        return false;
    }

    return true;
}