<?php

namespace app\core;

class Controller
{
    protected function view(string $view, $params = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/site/view/');

        $twig = new \Twig\Environment($loader, []);

        $twig->addGlobal('BASE', BASE);
        $twig->addGlobal('HOST', HOST);
        $twig->addGlobal('DATE_TIME', DATE_TIME);

        $twig->addGlobal('userName', \app\classes\Session::getValue('nome'));

        echo $twig->render($view . '.twig.php', $params);
    }

    protected function showMessage(string $title, string $message, int $httpCode = 404)
    {
        http_response_code($httpCode);

        $this->view('partials/message', [
            'title'     => $title,
            'message'   => $message,
            'httpCode' => $httpCode
        ]);
    }
}
