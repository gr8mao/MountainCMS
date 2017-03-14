<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 22.01.17
 * Time: 16:12
 */
class Router
{
    private $routes;

    public function __construct()
    {
        $routePath = ROOT . "/config/routes.php";
        $adminPath = ROOT . "/config/adminRoutes.php";
        $this->routes = array_merge(include ($adminPath), include ($routePath));
    }

    private function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI']))
        {
            return trim($_SERVER['REQUEST_URI'],'/');
        }
    }

    public function run()
    {
        $uri = $this->getURI();

        $result  = null;
        foreach($this->routes as $URIpattern => $path)
        {
            if(preg_match("~^$URIpattern~",$uri))
            {
                $internalRoute = preg_replace("~^$URIpattern~",$path,$uri);

                $segments = explode('/',$internalRoute);

                $controllerName = ucfirst(array_shift($segments) . 'Controller');
                $actionName = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;
                array_push($parameters, $uri);

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                if(file_exists($controllerFile))
                {
                    include_once ($controllerFile);
                }
                else
                {
                    include_once (ROOT . '/controllers/ErrorController.php');
                    $result = ErrorController::actionError500("File $controllerName does not exist in system");
                    break;
                }

                $controllerObject = new $controllerName;

                if(method_exists($controllerObject,$actionName))
                {
                    $result = call_user_func_array(array($controllerObject,$actionName),$parameters);
                    if($result){
                        break;
                    }
                    else
                    {
                        include_once (ROOT . '/controllers/ErrorController.php');
                        echo $uri;
                        $result = ErrorController::actionError404();
                        break;
                    }
                }
                else
                {
                    include_once (ROOT . '/controllers/ErrorController.php');
                    $result = ErrorController::actionError500("Method $actionName in $controllerName does not exist");
                    break;
                }
            }
        }

        if($result == null)
        {
            include_once (ROOT . '/controllers/ErrorController.php');
            $result = ErrorController::actionError404();
        }
    }
}