<?php 

namespace app\controllers;

use Exception;
use Jenssegers\Blade\Blade;

abstract class Controller 
{
    private $blade;

    protected function view(string $view, $data = [] )
    {
        $viewPath = dirname(__FILE__,2)."/views/".$view.".blade.php";  
        
        // dd($viewPath);
        if(file_exists($viewPath))
        {
            $this->blade = new Blade(dirname(__FILE__,2)."/views", dirname(__FILE__,2)."/cache");

            echo $this->blade->render($view,$data);
            
        }else{

            throw new Exception("A view {$view} não existe, erro");
        }

        
    }

    

    // echo $this->blade->render('category',compact('categories'));


}//end class