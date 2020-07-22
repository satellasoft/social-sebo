<?php

namespace app\site\controller;

use app\core\Controller;

class DashboardController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        \app\classes\security::protect();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $userId = \app\classes\Session::getValue('id');

        $this->view('dashboard/main', [
            'livros' => (new \app\site\model\LivroModel())->getUserLivros($userId)
        ]);
    }
}
