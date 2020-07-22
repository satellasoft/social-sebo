<?php

namespace app\site\controller;

use app\core\Controller;
use app\site\entitie\Categoria;
use app\site\entitie\Usuario;
use app\site\entitie\Livro;
use app\site\model\LivroModel;

class LivroController extends Controller
{
    private $livroModel;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->livroModel = new LivroModel();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $this->showMessage('Página inexistente', 'A página que você procura não existe ou foi abduzida', 404);
    }

    public function ver(string $slug = '')
    {
        $slug = filter_var($slug, FILTER_SANITIZE_STRING);

        dd($slug);

        $this->view('livro/ver');
    }

    public function novo()
    {
        \app\classes\security::protect();

        $this->view('livro/novo', [
            'categorias' => (new \app\site\model\CategoriaModel())->getAll()
        ]);
    }

    public function editar($livroId = null)
    {
        $livroId = filter_var($livroId, FILTER_SANITIZE_NUMBER_INT);
        $userId  = \app\classes\Session::getValue('id');

        $livro = $this->livroModel->getById($livroId, $userId);

        if ($livro->getId() <= 0 || $livro->getId() == null)
            return $this->showMessage('Livro inválido', 'O livro que você procura para editar não foi encontrado.', 422);

        $this->view('livro/editar', [
            'livro' => $livro,
            'categorias' => (new \app\site\model\CategoriaModel())->getAll()
        ]);
    }

    /* #### INTERNAL ####  */

    public function insert()
    {
        $livro = $this->getInput();

        if (!$this->validate($livro, false))
            return $this->showMessage('Formulário inválido', 'Os dados fornecidos são inválidos ou incompletos.', 422);


        $result = $this->livroModel->insert($livro);

        if ($result === -1) {
            $this->showMessage('Erro ao cadastrar', 'Houve um erro ao tentar cadastrar, tente novamente mais tarde.', 500);
            return;
        }

        redirect(BASE . 'livro/editar/' . $result);
    }

    public function update($id = null)
    {
        $livro = $this->getInput($id);

        $userId  = \app\classes\Session::getValue('id');

        if (!$this->validate($livro, true))
            return $this->showMessage('Formulário inválido', 'Os dados fornecidos são inválidos ou incompletos.', 422);


        if (!$this->livroModel->update($livro, $userId))
            $this->showMessage('Erro ao alterar', 'Houve um erro ao tentar alterar, tente novamente mais tarde.', 500);

        redirect(BASE . 'livro/editar/' . $id);
    }

    private function validate(Livro $livro, bool $validateId = true)
    {
        if ($validateId && $livro->getId() <= 0)
            return false;

        if (strlen(trim($livro->getTitulo())) < 2)
            return false;

        if (strlen(trim($livro->getSlug())) < 2)
            return false;

        if (strlen(trim($livro->getValor())) < 2)
            return false;

        if ($livro->getStatus() < 1 || $livro->getStatus() > 2)
            return false;

        if ($livro->getCategoria()->getId() <= 0 || $livro->getCategoria()->getId() == null)
            return false;

        if ($livro->getUsuario()->getId() <= 0 || $livro->getUsuario()->getId() == null)
            return false;

        return true;
    }

    private function getInput($id = null)
    {
        return new Livro(
            filter_var($id, FILTER_SANITIZE_NUMBER_INT),
            post('txtTitulo'),
            post('txtSlug'),
            post('txtValor'),
            null,
            post('txtSinopse', FILTER_SANITIZE_SPECIAL_CHARS),
            getCurrentDate(),
            post('slStatus', FILTER_SANITIZE_NUMBER_INT),
            new Categoria(
                post('slCategoria', FILTER_SANITIZE_NUMBER_INT)
            ),
            new Usuario(
                \app\classes\Session::getValue('id')
            )
        );
    }
}
