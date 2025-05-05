<?php
defined('ROOTPATH') or exit('Access denied');

class App
{
    private $controller = 'Home';
    private $method = 'index';

    private function splitURL()
    {
        // Set default route to 'home' if 'url' parameter is missing
        $URL = $_GET['url'] ?? 'home';

        // Split URL segments by '/'
        $URL = explode('/', trim($URL, "/"));

        return $URL;
    }

    public function loadController()
    {
        $URL = $this->splitURL();

        $controllerFolder = "../App/Controllers/";

        if (!empty($URL[1])) {
            $filename = $controllerFolder . ucfirst($URL[0]) . "/" . ucfirst($URL[1]) . ".php";
    
            if (file_exists($filename)) {
                require $filename;
                $this->controller = ucfirst($URL[1]);
                unset($URL[0], $URL[1]);
            }
        }

        if (!empty($URL[0])) {
            $filename = $controllerFolder . ucfirst($URL[0]) . ".php";
    
            if (file_exists($filename)) {
                require $filename;
                $this->controller = ucfirst($URL[0]);
                unset($URL[0]);
            }
        }

        $mycontroller = '\\Controller\\' . $this->controller;
        $controller = new $mycontroller;

        // Set method
        if (!empty($URL[2])) {
            if (method_exists($controller, $URL[2])) {
                $this->method = $URL[2];
                unset($URL[2]);
            }
        }

        call_user_func_array([$controller, $this->method], $URL);
    }



    private function load404Controller()
    {
        $filename = "../App/Controllers/_404.php";
        if (file_exists($filename)) {
            require $filename;
            $this->controller = '_404';
        } else {
            throw new Exception("404 Controller not found.");
        }
    }
}
