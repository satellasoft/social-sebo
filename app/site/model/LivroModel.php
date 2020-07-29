<?php

namespace app\site\model;

use app\site\entitie\Livro;
use app\site\entitie\Categoria;
use app\site\entitie\Usuario;

use app\core\Model;

class LivroModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Model();
    }

    public function insert(Livro $livro)
    {
        $sql = 'INSERT INTO livro (titulo, slug, valor, thumb, sinopse, data_cadastro, status, categoria_id, usuario_id) VALUES (:titulo, :slug, :valor, :thumb, :sinopse, :datacadastro, :status, :categoriaid, :usuarioid)';
        $params = [
            ':titulo' => $livro->getTitulo(),
            ':slug' => $livro->getSlug(),
            ':valor' => $livro->getValor(),
            ':thumb' => $livro->getThumb(),
            ':sinopse' => $livro->getSinopse(),
            ':datacadastro' => $livro->getDataCadastro(),
            ':status' => $livro->getStatus(),
            ':categoriaid' => $livro->getCategoria()->getId(),
            ':usuarioid' => $livro->getUsuario()->getId()
        ];

        if (!$this->pdo->ExecuteNonQuery($sql, $params))
            return -1;

        return $this->pdo->GetLastID();
    }

    public function update(Livro $livro, int $userId)
    {
        $sql = 'UPDATE livro SET titulo = :titulo, slug = :slug, valor = :valor, sinopse = :sinopse, status = :status, categoria_id = :categoriaid WHERE id = :id AND usuario_id = :usuarioid';
        $params = [
            ':id' => $livro->getId(),
            ':titulo' => $livro->getTitulo(),
            ':slug' => $livro->getSlug(),
            ':valor' => $livro->getValor(),
            ':sinopse' => $livro->getSinopse(),
            ':status' => $livro->getStatus(),
            ':categoriaid' => $livro->getCategoria()->getId(),
            ':usuarioid' => $userId
        ];

        return $this->pdo->ExecuteNonQuery($sql, $params);
    }

    public function updateThumb(string $thumb, int $livroId, int $userId)
    {
        $sql = 'UPDATE livro SET thumb = :thumb WHERE id = :livroid AND usuario_id = :usuarioid';
        $params = [
            ':livroid'   => $livroId,
            ':thumb'     => $thumb,
            ':usuarioid' => $userId
        ];

        return $this->pdo->ExecuteNonQuery($sql, $params);
    }

    public function getSlugLivros(string $slug)
    {
        $sql = 'SELECT l.id, l.slug, l.titulo, l.thumb FROM livro l INNER JOIN categoria c ON c.id = l.categoria_id WHERE LOWER(c.slug) = :slug AND l.status = :status ORDER BY l.titulo ASC';
        $param = [
            ':slug'   => $slug,
            ':status' => 1//ativo
        ];
        
        $dt = $this->pdo->ExecuteQuery($sql, $param);

        $list = [];

        foreach ($dt as $dr)
            $list[] = $this->collection($dr);

        return $list;
    }

    public function getLasts(int $quantidade = 12)
    {
        $sql = 'SELECT l.slug, l.titulo, l.thumb, l.valor FROM livro l INNER JOIN categoria c ON c.id = l.categoria_id WHERE l.status = :status ORDER BY l.titulo ASC LIMIT :quantidade';
        $param = [
            ':quantidade'   => $quantidade,
            ':status' => 1//ativo
        ];
        
        $dt = $this->pdo->ExecuteQuery($sql, $param);

        $list = [];

        foreach ($dt as $dr)
            $list[] = $this->collection($dr);

        return $list;
    }

    public function getUserLivros(int $userId)
    {
        $sql = 'SELECT l.id, l.slug, l.titulo, l.status, l.data_cadastro, c.nome as categoria_nome FROM livro l INNER JOIN categoria c ON c.id = l.categoria_id WHERE l.usuario_id = :usuarioid ORDER BY l.titulo ASC';
        $param = [
            ':usuarioid' => $userId
        ];

        $dt = $this->pdo->ExecuteQuery($sql, $param);
        $list = [];

        foreach ($dt as $dr)
            $list[] = $this->collection($dr);

        return $list;
    }

    public function getThumbById(int $livroId, int $userId)
    {
        $sql = 'SELECT id, thumb FROM livro WHERE id = :livroid AND usuario_id = :usuarioid';

        $dr = $this->pdo->ExecuteQueryOneRow($sql, [
            ':livroid' => $livroId,
            ':usuarioid' => $userId
        ]);

        return (object)[
            'id'    => $dr['id'] ?? null,
            'thumb' => $dr['thumb'] ?? null
        ];
    }

    public function getById(int $livroId, int $userId)
    {
        $sql = 'SELECT id, titulo, slug, valor, status, sinopse, categoria_id FROM livro WHERE id = :livroid AND usuario_id = :usuarioid';
        $params = [
            ':livroid' => $livroId,
            ':usuarioid' => $userId
        ];

        $dr = $this->pdo->ExecuteQueryOneRow($sql, $params);

        return $this->collection($dr);
    }

    public function getBySlug(string $slug)
    {
        $sql = 'SELECT l.id, l.titulo, l.slug, l.valor, l.thumb, l.sinopse, l.data_cadastro, u.nome as usuario_nome FROM livro l INNER JOIN usuario u ON u.id = l.usuario_id WHERE l.status = 1 AND LOWER(l.slug) = :slug';
        $params = [
            ':slug' => $slug
        ];

        $dr = $this->pdo->ExecuteQueryOneRow($sql, $params);

        return $this->collection($dr);
    }

    private function collection($param)
    {
        return new Livro(
            $param['id'] ?? null,
            $param['titulo'] ?? null,
            $param['slug'] ?? null,
            $param['valor'] ?? null,
            $param['thumb'] ?? null,
            html_entity_decode($param['sinopse'] ?? null),
            $param['data_cadastro'] ?? null,
            $param['status'] ?? null,
            new Categoria(
                $param['categoria_id'] ?? null,
                $param['categoria_nome'] ?? null,
            ),
            new Usuario(
                $param['usuario_id'] ?? null,
                $param['usuario_nome'] ?? null
            )
        );
    }
}
