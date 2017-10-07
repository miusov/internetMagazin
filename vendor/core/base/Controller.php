<?php

namespace vendor\core\base;


class Controller
{
    /**
     * текущий маршрут и параметры (controller, action, params)
     * @var array
     */
    public $route = [];

    /**
     * текущий вид
     * @var string
     */
    public $view;

    /**
     * текущий шаблон
     * @var string
     */
    public $layout;
    /**
     * пользовательские данные
     * @var array
     */
    public $vars = [];

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = $route['action'];
    }

    public function getView()
    {
        $vObj = new View($this->route, $this->layout,$this->view);
        $vObj->render($this->vars);
    }

    public function set($vars)
    {
        $this->vars = $vars;
    }

    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function loadView($view, $vars = [])
    {
        extract($vars);
        require APP."/views/{$this->route['controller']}/{$view}.php";
    }


    /**
     * Метод для очистки GET параметров полученных из адресной строки
     * @param $request - GET параметр
     * @return string - GET параметр без лишних тегов и символов
     */
    public function clr_str($request)
    {
        $req = strip_tags($request);
        $req = trim($req);
        return $req;
    }

    
}