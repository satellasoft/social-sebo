<?php

namespace app\site\model;

use app\core\Model;

class ComentarioModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Model();
    }

    public function insert($livroId, $usuarioId, $comentario)
    {
        $sql = 'INSERT INTO comentario (descricao, livro_id, usuario_id) VALUES (:descricao, :livroid, :usuarioid)';
        $params  = [
            ':descricao' => $comentario,
            ':livroid' => $livroId,
            ':usuarioid' => $usuarioId
        ];

        return $this->pdo->ExecuteNonQuery($sql, $params);
    }

    public function getAllByLivroId(int $livroId)
    {
        $sql = 'SELECT u.nome as usuarioNome, c.descricao as comentario FROM comentario c INNER JOIN usuario u ON u.id = c.usuario_id WHERE c.livro_id = :livroid ORDER BY c.id DESC';
        
        $dt = $this->pdo->ExecuteQuery($sql, [
            ':livroid' => $livroId
        ]);

        $listComentario = [];

        foreach($dt as $dr){
            $listComentario[] = [
                'usuarioNome' => $dr['usuarioNome'] ?? null,
                'comentario'  => $dr['comentario'] ?? null
            ];
        }

        return $listComentario;
    }
}
