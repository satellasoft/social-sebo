<?php

namespace app\site\entitie;
use app\site\entitie\Categoria;
use app\site\entitie\Usuario;

class Livro
{
    private $id;
    private $titulo;
    private $slug;
    private $valor;
    private $thumb;
    private $sinopse;
    private $dataCadastro;
    private $status;
    private $categoria;
    private $usuario;

    public function __construct($id = null, $titulo = null, $slug = null, $valor = null, $thumb = null, $sinopse = null, $dataCadastro = null, $status = 2, $categoria = null, $usuario = null)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->slug = $slug;
        $this->valor = $valor;
        $this->thumb = $thumb;
        $this->sinopse = $sinopse;
        $this->dataCadastro = $dataCadastro;
        $this->status = $status;
        $this->categoria = $categoria ?? new Categoria();
        $this->usuario = $usuario ?? new Usuario();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function getThumb()
    {
        return $this->thumb;
    }

    public function getSinopse()
    {
        return $this->sinopse;
    }

    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }
}
