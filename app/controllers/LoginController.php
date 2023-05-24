<?php

namespace app\controllers;
use app\controllers\Controller;
use app\core\Request;

class LoginController extends Controller
{

    public function index()
    {
        $this->view('login');
    }//end methods

    public function login()
    {
        dd(Request::all());
    }


}//end class
