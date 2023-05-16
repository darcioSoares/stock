<?php 

namespace app\core;

use app\utility\RequestType;
use app\utility\Uri;
use app\routes\Routes;

class FilterRoute
{

    private string $uri;
    private string $method;
    private array $routerRegistered;

    public function __construct()
    {
        $this->uri = Uri::get();
        $this->method = RequestType::get();
        $this->routerRegistered = Routes::get();
    }


    private function simplesRouter()
    {
        if(array_key_exists($this->uri, $this->routerRegistered[$this->method]))
        {
            return $this->routerRegistered[$this->method][$this->uri];
        }

        return null;        

    }//end methods

    private function dynamicRouter()
    {
        //$route -> '/'  $controller -> 'Controller@index'
        foreach($this->routerRegistered[$this->method] as $route => $controller)
        {
            $regex = str_replace('/', '\/', trim($route, '/'));

                // /teste/[0-9]+ depois do replace fica teste\/[0-9]+
            if($route !== "/" && preg_match("/^$regex$/", ltrim($this->uri, '/')))
            {
                $controllerFound = $controller;
                break;
            }else{
                $controllerFound = null;
            }           
        }

        return $controllerFound;

    }//end method



    public function get()
    {
        // routers simples -> / ou /user
        $controller = $this->simplesRouter();
        if($controller) return $controller;

        // router dynamic -> /user/12
        $controller = $this->dynamicRouter();
        if($controller) return $controller;


        return 'NotFoundController@index';

    }//end method


}//end class