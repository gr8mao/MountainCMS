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
        $routePath = "config/routes.php";
        $this->routes = include ($routePath);
    }

    private function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'],'/');
        }
    }

    public function run()
    {
        $uri = $this->getURI();

        $result  = null;
        foreach($this->routes as $URIpattern => $path){
            if(preg_match("~^$URIpattern~",$uri)){
                $internalRoute = preg_replace("~^$URIpattern~",$path,$uri);

                $segments = explode('/',$path);

                $controllerName = ucfirst(array_shift($segments) . 'Controller');
                $actionName = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;

                $controllerFile = ROOT . '/controllers/' . $controllerName;

                if(file_exists($controllerFile)){
                    include_once ($controllerFile);
                }
                else
                {
                    // TODO: 500 error callback
                }

                $controllerObject = new $controllerName;

                if(method_exists($controllerObject,$actionName)){
                    $result = call_user_func_array(array($controllerObject,$actionName),$parameters);
                    if($result){
                        break;
                    }
                    else
                    {
                        // TODO: 500 error callback
                    }
                }
                else
                {
                    // TODO: 500 error callback
                }
            }
        }

        if($result == null){
            // TODO: 404 error callback
        }
    }
}