<?php 

namespace app\core;

use Throwable;

class Router 
{
    public static function run()
    {
      
        try{
                       
            $routerController = new FilterRoute();
            $PathController = $routerController->get();

            $controller = new Controller();
            $controller->execute($PathController);


        }catch(Throwable $e){

            dd($e->getMessage());
        }

    }//end method

}//end class