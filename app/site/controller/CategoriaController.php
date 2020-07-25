<?php

namespace app\site\controller;

use app\core\Controller;
use app\site\entitie\Categoria;
use app\site\model\CategoriaModel;

class CategoriaController extends Controller
{
    private $categoriaModel;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->categoriaModel = new CategoriaModel();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $this->view('categoria/main', [
            'categorias' => $this->categoriaModel->getAll()
        ]);
    }

    public function ver(string $slug = '')
    {
        $slug = filter_var($slug, FILTER_SANITIZE_STRING);
        $slug = strtolower($slug);

        $livros = (new \app\site\model\LivroModel())->getSlugLivros($slug);
        $categoria = $this->categoriaModel->getBySlug($slug);

        $this->view('categoria/ver', [
            'livros'    => arrayTree($livros, 4),
            'categoria' => $categoria
        ]);
    }

    public function lista()
    {
        \app\classes\security::protect();
        $this->view('categoria/lista', [
            'categorias' => $this->categoriaModel->getAll()
        ]);
    }

    public function nova()
    {
        \app\classes\security::protect();
        $this->view('categoria/nova');
    }

    public function editar($id = 0)
    {
        \app\classes\security::protect();

        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        if ($id <= 0)
            return  $this->showMessage('ID inválido', 'O ID informado é inválido.', 422);

        $categoria = $this->categoriaModel->getById($id);

        if ($categoria->getId() == null || $categoria->getId() <= 0)
            return  $this->showMessage('Categoria não encontrada', 'A categoria que você procura não foi encontrada.', 404);

        $this->view('categoria/editar', [
            'categoria' => $categoria
        ]);
    }

    /*#### INTERNAL ####*/

    public function insert()
    {
        \app\classes\security::protect();

        $categoria = $this->getInput();

        if (!$this->validate($categoria, false)) {
            $this->showMessage('Formulário inválido', 'Os dados fornecidos são inválidos', 422);
            return;
        }

        $result = $this->categoriaModel->insert($categoria);

        if ($result === -1) {
            $this->showMessage('Erro ao cadastrar', 'Houve um erro ao tentar cadastrar, tente novamente mais tarde.', 500);
            return;
        }

        redirect(BASE . 'categoria/editar/' . $result);
    }

    public function update($id = 0)
    {
        \app\classes\security::protect();

        $categoria = $this->getInput($id);

        if (!$this->validate($categoria, true)) {
            $this->showMessage('Formulário inválido', 'Os dados fornecidos são inválidos', 422);
            return;
        }

        if (!$this->categoriaModel->update($categoria))
            return $this->showMessage('Erro ao alterar inválido', 'Houve um erro ao tentar alterar, tente novamente mais tarde.', 500);

        redirect(BASE . 'categoria/editar/' . $id);
    }

    private function validate(Categoria $categoria, bool $validateId = true)
    {
        if ($validateId && $categoria->getId() <= 0)
            return false;

        if (strlen(trim($categoria->getNome())) < 2)
            return false;

        if (strlen(trim($categoria->getSlug())) < 2)
            return false;

        return true;
    }

    private function getInput($id = null)
    {
        return new Categoria(
            filter_var($id, FILTER_SANITIZE_NUMBER_INT),
            post('txtNome'),
            post('txtSlug')
        );
    }
}
