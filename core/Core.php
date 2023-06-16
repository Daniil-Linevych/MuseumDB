<?php

namespace core;

use controllers\MainController;

class Core
{
    private static $instance = null;
    public $app;
    public $pageParams;
    public $db;
    public $typeRequest;
    private $isSuccess = true;

    private function __construct()
    {
        global $pageParams;
        $this->app = [];
        $this->pageParams = $pageParams;
    }
    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function Initialize() {
        session_start();
        $this->db = new DataBase();
        $this->typeRequest = $_SERVER['REQUEST_METHOD'];
    }
    public function Run() {
        $route = $_GET['route'];
        $routeParts = explode('/', $route);
        $moduleName = strtolower(array_shift($routeParts));
        $operationName = strtolower(array_shift($routeParts));
        if (empty($moduleName))
            $moduleName = "main";
        if (empty($operationName))
            $operationName = "index";
        $this->app['moduleName'] = $moduleName;
        $this->app['actionName'] = $operationName;
        $controllerName = '\\controllers\\'.ucfirst($moduleName)."Controller";
        $controllerActionName = "operation".ucfirst($operationName);
        $statusCode = 200;
        if (class_exists($controllerName)) {
            $controller = new $controllerName();

            if (method_exists($controller, $controllerActionName)) {
                $actionResult = $controller->$controllerActionName($routeParts);
                if ($actionResult instanceof Error)
                    $statusCode = $actionResult->errorCode;
                $this->pageParams['Content'] = $actionResult;
            }
            else {
                $statusCode = 404;
                $this->isSuccess = false;
            }
        } else
        {
            $statusCode = 404;
            $this->isSuccess = false;
        }
        $statusCodeType = intval($statusCode / 100);
        if ($statusCodeType == 4 || $statusCodeType == 5) {
            $mainController = new MainController();
            $this->pageParams['Content'] = $mainController->operationError($statusCode);
        }
    }
    public function Done() {
        if ($this->isSuccess)
            $pathToLayout = 'themes/light/layout.php';
        else
            $pathToLayout = 'themes/error/layout.php';
        $tpl = new Template($pathToLayout);
        $tpl->setParams($this->pageParams);
        $html = $tpl->getHTML();
        echo $html;
    }
}