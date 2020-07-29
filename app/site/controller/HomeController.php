<?php

namespace app\site\controller;

use app\core\Controller;

class HomeController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $livros = (new \app\site\model\LivroModel())->getLasts(12);

        $this->view('home/main', [
            'livros' => arrayTree($livros, 4)
        ]);
    }
}
