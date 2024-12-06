<?php
session_start();
require_once('./TLUNews/Config/config.php');
require_once APP_ROOT. '/TLUNews/Config/DBConnection.php';
require_once APP_ROOT. '/TLUNews/controllers/HomeController.php';
require_once APP_ROOT. '/TLUNews/controllers/NewsController.php';
require_once APP_ROOT. '/TLUNews/controllers/AdminController.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Router {
    private $controller = 'HomeController';
    private $method = 'index';
    private $params = [];

    public function __construct() {
        $url = $this->parseUrl();
        
        if (file_exists('controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }

        $this->controller = new $this->controller();

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return ['home'];
    }
}

new Router();
?>