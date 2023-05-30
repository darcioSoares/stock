<?php 

namespace app\controllers;
use app\core\Request;
use app\utility\Csrf;

class TestController extends Controller
{
    public function index()
    {       
        $this->view('teste');
    }

    public function teste($params)
    {
        Csrf::validatorCsrf();        
        
        dd("TestControlle -> ok");
    }

}//end 