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
        $resulValidation = \Helper::validatorRequestEmpty(Request::all());

        if(isset($resulValidation['validatorError']))
        {
            $_SESSION['error_login'] = 'Senha ou Usuario, incorreto';                
            header("location: login");
            die();
        }

        $request = Request::all();
                      
        $user = new User();
        $result = $user->login($request);

        if($result['status']){
        
            $password = openssl_decrypt($result['password'],
            $_ENV['CIPHER_METHODS'],
            $_ENV['SECRET'],
            0,
            $_ENV['SECRET_2'] );

            if($request['password'] === $password){

                unset($result['password']);                                            
                $_SESSION['user'] = $result;                               
                header("location: home");
                die();

            }else{
                $_SESSION['error_login'] = 'Senha ou Usuario, incorreto';                
                header("location: login");
                die();
            }
        }else{
            $_SESSION['error_login'] = 'Usuario ou Senha incorreto';
                  header("location: login");
             die();
        }

    }


}//end class
