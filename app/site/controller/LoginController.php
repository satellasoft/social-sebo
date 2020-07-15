<?php

namespace app\site\controller;
use app\core\Controller;

class LoginController extends Controller
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
       $this->view('login/login');
    }
}
