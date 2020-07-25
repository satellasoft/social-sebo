<?php

namespace app\site\model;

use app\site\entitie\Categoria;

use app\core\Model;

class CategoriaModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Model();
    }

    public function insert(Categoria $categoria)
    {
        $sql = 'INSERT INTO categoria (nome, slug) VALUES (:nome, :slug)';
        $params  = [
            ':nome' => $categoria->getNome(),
            ':slug' => $categoria->getSlug()
        ];

        if (!$this->pdo->ExecuteNonQuery($sql, $params))
            return -1;

        return $this->pdo->GetLastID();
    }

    public function update(Categoria $categoria)
    {
        $sql = 'UPDATE categoria SET nome = :nome, slug = :slug WHERE id = :id';
        $params  = [
            ':id' => $categoria->getId(),
            ':nome' => $categoria->getNome(),
            ':slug' => $categoria->getSlug()
        ];

        return $this->pdo->ExecuteNonQuery($sql, $params);
    }

    public function getById(int $id)
    {
        $sql = 'SELECT * FROM categoria WHERE id = :id';

        return $this->collection($this->pdo->ExecuteQueryOneRow($sql, [
            ':id' => $id
        ]));
    }

    public function getBySlug(string $slug)
    {
        $sql = 'SELECT nome FROM categoria WHERE slug = :slug';

        return $this->collection($this->pdo->ExecuteQueryOneRow($sql, [
            ':slug' => $slug
        ]));
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM categoria ORDER BY nome ASC';

        $dt = $this->pdo->ExecuteQuery($sql);

        $list = [];

        foreach ($dt as $dr)
            $list[] = $this->collection($dr);

        return $list;
    }

    private function collection($param)
    {
        return new Categoria(
            $param['id'] ?? null,
            $param['nome'] ?? null,
            $param['slug'] ?? null
        );
    }
}
