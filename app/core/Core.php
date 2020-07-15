<?php

namespace app\core;

class Core
{
    private $controller;
    private $method;
    private $params = [];
    private $explodeURI;

    public function __construct()
    {
        $this->initialize();

        $this->execute();
    }

    private function initialize()
    {
        $uri = $_SERVER['REQUEST_URI'];
        
        $uri = str_replace('?', '/', $uri);

        $uri = explode('/', $uri);
        $uri = array_values(array_filter($uri));

        for ($i = 0; $i < REMOVE_INDEX_COUNT; $i++)
            unset($uri[$i]);

        $this->explodeURI = array_values(array_filter($uri));

        $this->controller = $this->getController();
        $this->method = $this->getMethod();
        $this->params = $this->getParams();
    }

    private function execute()
    {
        call_user_func_array([
            new $this->controller,
            $this->method
        ], $this->params);
    }

    private function getController()
    {
        $controller = 'Home';

        if (isset($this->explodeURI[0])) {
            $controller = ucfirst($this->explodeURI[0]);
        }

        $controller = "\\app\\site\\controller\\{$controller}Controller";

        if (class_exists($controller))
            return $controller;

        return "\\app\\site\\controller\\HomeController";
    }

    private function getMethod()
    {
        $method = 'index';

        if (isset($this->explodeURI[1]))
            $method = $this->explodeURI[1];

        if (method_exists($this->controller, $method))
            return $method;

        return 'index';
    }

    private function getParams()
    {
        if (!isset($this->explodeURI[2]))
            return [];

        $params = [];

        for ($i = 2; $i < count($this->explodeURI); $i++)
            $params[] = $this->explodeURI[$i];

        return $params;
    }
}
