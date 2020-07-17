<?php

namespace app\site\controller;

use app\core\Controller;
use app\site\entitie\Usuario;
use app\site\model\UsuarioModel;

class LoginController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $this->view('login/login');
    }

    public function recuperar()
    {
        $this->view('login/redefinir-senha-email');
    }

    public function recuperarSenhaExterno(string $token = '')
    {
        $token = filter_var($token, FILTER_SANITIZE_STRING);

        if (strlen(trim($token)) <= 10) {
            $this->showMessage('Token inválido', 'O token informado é inválido.', 422);
            return;
        }

        $this->view('login/redefinir-senha-externo', [
            'token' => $token
        ]);
    }

    public function cadastrar()
    {
        $this->view('login/cadastro');
    }

    public function editar()
    {
        \app\classes\security::protect();
        $this->view('login/editar', [
            'usuario' => (new UsuarioModel())->obterPorId(\app\classes\Session::getValue('id'))
        ]);
    }

    public function senha()
    {
        \app\classes\security::protect();
        $this->view('login/redefinir-senha-interno');
    }

    /* ####### INTERNAL ####### */

    public function auth()
    {
        $email = strtolower(trim(post('txtEmail')));
        $senha = post('txtSenha');

        $usuario = (new UsuarioModel())->dadosPorEmail($email);
        if (!password_verify($senha, $usuario->getSenha())) {
            $this->showMessage('Dados inválidos', 'E-mail ou senha inválido.', 422);
            return;
        }

        $nome = explode(' ', $usuario->getNome());

        \app\classes\Session::setValue('id', $usuario->getId());
        \app\classes\Session::setValue('nome', mb_substr($nome[0], 0, 10));
        \app\classes\Session::setValue('logged', true);
        \app\classes\Session::setValue('ip', $_SERVER['REMOTE_ADDR']);

        redirect(BASE . 'dashboard/');
    }

    public function updatePassword()
    {
        \app\classes\security::protect();

        $pass = passwordHash(post('txtSenha'));
        $usuarioId = \app\classes\Session::getValue('id');

        if (!(new UsuarioModel())->updatePassword($pass, $usuarioId)) {
            $this->showMessage('Erro ao alterar senha', 'Houve um erro durante a tentativa de alteração de senha, tente novamente mais tarde.', 500);
            return;
        }

        $this->showMessage('Alterado', 'Sua senha foi redefinida com sucesso', 200);
    }

    public function recuperarSenhaEmail()
    {
        $email = post('txtEmail', FILTER_SANITIZE_EMAIL);
        $email = trim(strtolower($email));


        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->dadosPorEmailRedefinir($email);

        if ($usuario->getId() == null || $usuario->getId() <= 0) {
            $this->showMessage('E-mail não encontrado', 'O e-mail informado não pode ser encontrado.', 422);
            return;
        }

        $token = uniqid(md5($usuario->getNome()) . '-', true);

        if (!$usuarioModel->updateToken($usuario->getId(), $token)) {
            $this->showMessage('Não foi possível enviar o e-mail', 'Houve um erro ao tentar enviar o e-mail de recuperação, por favor, tente mais tarde.', 500);
            return;
        }

        $link = HOST . 'login/recuperarSenhaExterno/' . $token;

        $msg = '<h1>Social Sebo</h1>' .
            '<p>Para redefinir a sua senha, por favor, <a href="' . $link . '">clique aqui</a>, mas caso não consiga, basta inserir o link <strong>' . $link . '</strong> no seu navegador.</p>';

        \app\classes\Email::send([
            'assunto' => 'Recuperar senha',
            'mensagem' => $msg,
            'email' => $usuario->getEmail(),
            'nome' => $usuario->getNome()
        ]);

        $this->showMessage('E-mail enviado', 'Enviamos um e-mail com instruções de como redefinir a sua senha para <strong>' . $usuario->getEmail() . '</strong>. Caso não tenha recebido, verifique a sua caixa de spam.', 200);
    }

    public function updatePasswordExternal()
    {
        $senha  = post('txtSenha');
        $token  = post('txtToken');

        if (strlen(trim($token)) < 10 || strlen(trim($senha)) < 7) {
            $this->showMessage('Senha ou token inválido', 'A senha informada ou o token não estão corretos.', 422);
            return;
        }

        $senha = passwordHash($senha);

        if (!(new UsuarioModel())->updatePasswordByToken($senha, $token)) {
            $this->showMessage('Erro', 'Houve um erro ao tentar alterar a senha, tente novamente mais tarde.', 500);
            return;
        }

        $this->showMessage('Alterada', 'Senha alterada com sucesso, <a href="' . BASE . 'login/">clique aqui</a> para ir até a página de login.', 200);
    }

    public function logout()
    {
        \app\classes\Session::destroy();
        redirect(BASE . 'login/');
    }

    public function insert()
    {
        $usuario = $this->getInput();

        if (!$this->validate($usuario, false, true)) {
            $this->showMessage('Formulário inválido', 'Os dados fornecidos são inválidos.', 422);
            return;
        }

        $usuario->setSenha(passwordHash($usuario->getSenha()));
        $usuarioModel = new UsuarioModel();

        //Valida se o e-mail existe
        if ($usuarioModel->checaEmailExiste($usuario->getEmail())) {
            $this->showMessage('E-mail já cadastrado', 'O E-mail informado já está em uso por outro usuário.', 422);
            return;
        }

        //Tenta cadastrar
        if (!$usuarioModel->insert($usuario)) {
            $this->showMessage('Erro ao cadastrar', 'Houve um erro ao tentar cadastrar, tente novamente mais tarde.', 500);
            return;
        }

        $this->showMessage('Usuário cadastrado', 'Usuário cadastrado com sucesso!', 200);
    }

    public function update()
    {
        $usuario = $this->getInput(\app\classes\Session::getValue('id'));

        if (strlen($usuario->getNome()) <= 5) {
            $this->showMessage('Formulário inválido', 'Os dados fornecidos são inválidos.', 422);
            return;
        }

        //Tenta Alterar
        if (!(new UsuarioModel)->update($usuario)) {
            $this->showMessage('Erro ao alterar', 'Houve um erro ao tentar alterar, tente novamente mais tarde.', 500);
            return;
        }

        $this->showMessage('Usuário alterado', 'Usuário alterado com sucesso, recomendamos fazer o login novamente para que algumas informaçõe sejam reprocessadas!', 200);
    }

    private function validate(
        Usuario $usuario,
        bool $validateId = false,
        bool $validatePass = false
    ) {
        if ($validateId && $usuario->getId() <= 0)
            return false;

        if (strlen($usuario->getNome()) <= 5)
            return false;

        if (!preg_match('/.+@.+\..+/', $usuario->getEmail()))
            return false;

        if ($validatePass && strlen($usuario->getSenha()) < 7)
            return false;

        return true;
    }

    private function getInput($id = null)
    {
        return new Usuario(
            filter_var($id, FILTER_SANITIZE_NUMBER_INT),
            post('txtNome'),
            post('txtEmail'),
            post('txtSenha'),
            1, //Ativo
            null
        );
    }
}
