<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 22.01.17
 * Time: 16:12
 */
class CoreRouter
{
    private $routes;
    private $controller;
    private $action;
    private $parameters;

    public function __construct()
    {
        $routePath = MTN_ROOT . MTN_CORE . "/config/routes.php";
        $this->routes = include($routePath);
    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI']);
        }
    }

    private function isTechPage($uri)
    {
        foreach ($this->routes as $URIpattern => $path) {
            if (preg_match("~^$URIpattern~", $uri)) {
                $internalRoute = preg_replace("~^$URIpattern~", $path, $uri);

                $segments = explode('/', $internalRoute);

                $this->controller = ucfirst(array_shift($segments) . 'Controller');
                $this->action = 'action' . ucfirst(array_shift($segments));
                $this->parameters[] = $segments;

                return true;
            }
        }

        return false;
    }

    public function run()
    {
        $uri = $this->getURI();

        $result = null;

        $pageExist = Page::checkPageExist($uri);
        $isTechPage = $this->isTechPage($uri);

        if ($isTechPage or $pageExist) {
            if ($pageExist) {
                $this->controller = 'PageController';
                $this->action = 'actionPage';
                $this->parameters[] = $uri;
            }

            $controllerFile = MTN_ROOT . MTN_CORE . '/controllers/' . $this->controller . '.php';

            if (file_exists($controllerFile)) {
                include_once($controllerFile);
            } else {
                return ErrorController::actionError500("File $this->controller does not exist in system");
            }

            $controllerObject = new $this->controller;

            if (method_exists($controllerObject, $this->action)) {
                $result = call_user_func_array(array($controllerObject, $this->action), $this->parameters);
                if ($result) {
                    Log::logAccess();
                    return true;
                } else {
                    return ErrorController::actionError404();
                }
            } else {
                return ErrorController::actionError500("Method $this->action in $this->controller does not exist");
            }
        }

        return ErrorController::actionError404();
    }
}