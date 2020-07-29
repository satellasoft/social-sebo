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

        $livro = $this->livroModel->getBySlug($slug);

        if ($livro->getTitulo() == null)
            return $this->showMessage('Livro não encontrado', 'O livro que você procura não foi encontrado', 404);

        $this->view('livro/ver', [
            'livro' => $livro
        ]);
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
        \app\classes\security::protect();

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

    public function thumb($idLivro = null)
    {
        \app\classes\security::protect();

        $idLivro = filter_var($idLivro, FILTER_SANITIZE_STRING);
        $userId  = \app\classes\Session::getValue('id');

        $livro = $this->livroModel->getThumbById($idLivro, $userId);

        $this->view('livro/thumb', [
            'idLivro' => $idLivro,
            'thumb'   => $livro->thumb != null ? HOST . IMAGE_PATH . $livro->thumb : null
        ]);
    }

    /* #### INTERNAL ####  */

    public function updateThumb($idLivro)
    {
        \app\classes\security::protect();

        $idLivro = filter_var($idLivro, FILTER_SANITIZE_STRING);
        $userId = \app\classes\Session::getValue('id');

        $livro = $this->livroModel->getThumbById($idLivro, $userId);

        if ($livro->id == null || $livro->id <= 0)
            return $this->showMessage('Livro não encontrado', 'O livro que você procura para alterar não pode ser encontrado.', 404);

        if (!\app\classes\Upload::validate($_FILES['flThumb']))
            return $this->showMessage('Imagem inválida', 'A imagem está no formato inválido.', 422);

        $imageName = \app\classes\Upload::upload($_FILES['flThumb']);
        if ($imageName == null || $imageName == 'error')
            return $this->showMessage('Erro ao upload imagem', 'Houve um erro ao tentar fazer o upload da imagem, tente novamente mais tarde.', 500);

        if (!$this->livroModel->updateThumb($imageName, $idLivro, $userId)) {
            unlink(IMAGE_PATH . $imageName);
            $this->showMessage('Erro ao alterar thumb', 'Não foi possível alterar a thumb, por favor, tente novamente mais tarde.', 500);
        }

        unlink(IMAGE_PATH  . $livro->thumb);

        redirect(BASE . 'livro/thumb/' . $idLivro);
    }

    public function insert()
    {
        \app\classes\security::protect();

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
        \app\classes\security::protect();

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
