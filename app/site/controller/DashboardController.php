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
        $this->view('dashboard/main');
    }
}
