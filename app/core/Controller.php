<?php 

namespace app\core;

use Exception;

class Controller 
{

    private const NAMESPACE = "app\controllers\\";

    public function execute($pathController)
    {

        if(substr_count($pathController, '@') == 0)
        {
            throw new Exception("A rota está formada com o formato errado");
        }

        list($controller, $method) = explode('@', $pathController);

        $controllerNamespace = self::NAMESPACE.$controller;

        if(!class_exists($controllerNamespace))
        {
            throw new Exception("O controller {$controller} não existe");
        }

        $controllerInstance = new $controllerNamespace();
        
        if(!method_exists($controllerInstance, $method))
        {
            throw new Exception("O metodo {$method} não foi encontrado");
        }

        //trabalhando com os paramentros
        $params = new GettingParams();
        $params = $params->get($pathController);


        $controllerInstance->$method($params);


    }//end method

}//end class