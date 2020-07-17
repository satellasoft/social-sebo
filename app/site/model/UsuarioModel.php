<?php

namespace app\site\model;

use app\site\entitie\Usuario;

use app\core\Model;

class UsuarioModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Model();
    }

    public function insert(Usuario $usuario)
    {
        $sql = 'INSERT INTO usuario (nome, email, senha, status) VALUES (:nome, :email, :senha, :status)';

        $params = [
            ':nome'   => $usuario->getNome(),
            ':email'  => $usuario->getEmail(),
            ':senha'  => $usuario->getSenha(),
            ':status' => $usuario->getStatus()
        ];

        return $this->pdo->ExecuteNonQuery($sql, $params);
    }

    
    public function update(Usuario $usuario)
    {
        $sql = 'UPDATE usuario SET nome = :nome WHERE id = :id';

        $params = [
            ':id'  => $usuario->getId(),
            ':nome'   => $usuario->getNome()
        ];

        return $this->pdo->ExecuteNonQuery($sql, $params);
    }

    public function checaEmailExiste(string $email)
    {
        $sql = 'SELECT id FROM usuario WHERE email = :email';

        $dr = $this->pdo->ExecuteQueryOneRow($sql, [
            ':email' => $email
        ]);

        if (isset($dr['id']))
            return true;

        return false;
    }

    public function obterPorId(int $usuarioId)
    {
        $sql = 'SELECT nome, email FROM usuario WHERE id = :id';

        $dr = $this->pdo->ExecuteQueryOneRow($sql, [
            ':id' => $usuarioId
        ]);

        return $this->collection($dr);
    }

    public function dadosPorEmail(string $email)
    {
        $sql = 'SELECT id, nome, senha FROM usuario WHERE email = :email AND status = :status';

        $dr = $this->pdo->ExecuteQueryOneRow($sql, [
            ':email'  => $email,
            ':status' => 1
        ]);

        return $this->collection($dr);
    }

    private function collection($param)
    {
        return new Usuario(
            $param['id'] ?? null,
            $param['nome'] ?? null,
            $param['email'] ?? null,
            $param['senha'] ?? null,
            $param['status'] ?? null,
            $param['token'] ?? null
        );
    }
}
