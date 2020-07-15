<?php

namespace app\site\controller;
use app\core\Controller;

class AboutController extends Controller
{

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
       $this->view('about/quem-somos');
    }
}
