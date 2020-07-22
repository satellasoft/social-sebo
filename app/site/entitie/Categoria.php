<?php

namespace app\site\entitie;

class Categoria
{
    private $id;
    private $nome;
    private $slug;

    public function __construct($id = null, $nome = null, $slug = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->slug = $slug;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getSlug()
    {
        //Obtemos o valor da propriedade
        $str = $this->slug;

        //Removemos o espaço no começo e fim
        $str = trim($str);

        //Colocamos as letras na minúscula
        $str = strtolower($str);

        //Trocamos alguns carácteres por traço
        $str = str_replace([
            ' ', '.', ',', '+', '*'
        ], '-', $str);

        //Retornamos a string tratada
        return $str;
    }
}
