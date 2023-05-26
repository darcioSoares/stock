<?php

namespace app\controllers;
use app\controllers\Controller;
use app\core\Request;
use app\models\User;

class LoginController extends Controller
{

    public function index()
    {
        $this->view('login');
    }//end methods

    public function login()
    {
        // dd(Request::all());
        $user = new User();

        $result = $user->login(Request::all());

        dd($result);

    }


}//end class
