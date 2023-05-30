<?php 

namespace app\controllers;
use app\core\Request;

class TestController extends Controller
{
    public function index()
    {       
        $this->view('teste');
    }

    public function teste($params)
    {
        //$this->view('teste');
        dd("TestControlle ->");
    }

}//end 