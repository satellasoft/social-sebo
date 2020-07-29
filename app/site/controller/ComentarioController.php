<?php

namespace app\site\controller;

use app\core\Controller;
use app\site\model\ComentarioModel;

class ComentarioController extends Controller
{

    private $comentarioModel;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->comentarioModel = new ComentarioModel();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
    }

    public function getLivro(int $livroId)
    {
        $livroId   = filter_var($livroId, FILTER_SANITIZE_STRING);

        if ($livroId <= 0)
            return responseJson([]);

        return responseJson($this->comentarioModel->getAllByLivroId($livroId));
    }

    public function insert($livroId = 0)
    {
        $livroId   = filter_var($livroId, FILTER_SANITIZE_STRING);
        $usuarioId = \app\classes\Session::getValue('id');
        $comentario = post('comentario');

        if (!$this->validate($livroId, $usuarioId, $comentario))
            return responseJson([
                'code' => -10,
                'msg'  => 'Campos inválidos.'
            ]);

        if (!$this->comentarioModel->insert($livroId, $usuarioId, $comentario))
            return responseJson([
                'code' => -1,
                'msg'  => 'Houve um erro ao tentar inserir comentário.'
            ]);

        return responseJson([
            'code' => 1,
            'msg'  => 'Comentário enviado com sucesso.'
        ]);
    }

    private function validate($livroId, $usuarioId, $comentario)
    {
        if ($livroId <= 0)
            return false;

        if ($usuarioId <= 0)
            return false;

        if (strlen($comentario) < 10 || strlen($comentario) > 500)
            return false;

        return true;
    }
}
