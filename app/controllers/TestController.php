<?php 

namespace app\controllers;
use app\core\Request;
use app\utility\Csrf;
use app\utility\Validate;

class TestController extends Controller
{
    public function index()
    {       
        $this->view('teste');
    }

    public function teste($params)
    {
        // Csrf::validatorCsrf();        

        // dd("chgou");

        $validate = new Validate();

        $validate->validator([
            // 'firstName'=> 'required',
            // 'lastName'=> 'required',
            // 'email' => 'email|required',
            'password'=>'maxLen:10|required'
            
        ]);


        
        // dd("TestControlle -> ok");
    }

}//end 