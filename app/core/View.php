<?php

namespace app\core;

class View
{
    public $title;
    public $layout = 'default';
    public $route;
    public $action;

    public function __construct($route)
    {
        $this->route = $route;
        $this->action = $route['action'];
    }

    public function render($view, $vars = [])
    {
        $adminAccess = isset($_SESSION['admin']);
        extract($vars);
        $path = 'app/views/'.$view.'.php';
        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require 'app/views/layouts/'.$this->layout.'.php';
        }
    }

    public function redirect($url)
    {
        header('location: '.$url);
        exit;
    }

    public function message($status, $message)
    {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    public function location($url)
    {
        exit(json_encode(['url' => $url]));
    }

    public static function errorCode($code)
    {
        http_response_code($code);
        $path = 'app/views/errors/'.$code.'.php';
        if (file_exists($path)) {
            require $path;
        }
        exit;
    }
}