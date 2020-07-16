'use strict'

function validarLogin() {
    var email = getValueById('txtEmail');

    if (!/.+@.+\..+/.test(email)) {
        getById('dvAlert').innerHTML = '<div class="alert alert-warning">Informe o e-mail cadastrado.</div>';
        return false;
    }

    if (getValueById('txtSenha').trim().length < 7) {
        getById('dvAlert').innerHTML = '<div class="alert alert-warning">Informe uma senha válida.</div>';
        return false;
    }

    return true;
}

function validarCadastro() {

    if (getValueById('txtNome').trim().length <= 5) {
        getById('dvAlert').innerHTML = '<div class="alert alert-warning">Informe um nome válido.</div>';
        return false;
    }

    var email = getValueById('txtEmail');
    if (!/.+@.+\..+/.test(email)) {
        getById('dvAlert').innerHTML = '<div class="alert alert-warning">Informe o e-mail cadastrado.</div>';
        return false;
    }

    if (
        (getValueById('txtSenha').trim().length < 7 || getValueById('txtSenhaConfirmar').trim().length < 7)
        ||
        (getValueById('txtSenha') != getValueById('txtSenhaConfirmar'))
    ) {
        getById('dvAlert').innerHTML = '<div class="alert alert-warning">As senhas não correspondem ou são inválidas.</div>';
        return false;
    }

    return true;
}