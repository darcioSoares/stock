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
        $resulValidation = \Helper::validatorRequest(Request::all());

        if(isset($resulValidation['validatorError']))
        {
            echo json_encode(["status"=>false,"msg"=> 'Campos Obrigatorio']);
            return;
        }
        

        if(isset(Request::all()['email'])) echo json_encode(["status"=>false,"msg"=> 'Email obrigatorio']);
        
        $user = new User();

        $result = $user->login(Request::all());

        dd($result);

    }


}//end class
