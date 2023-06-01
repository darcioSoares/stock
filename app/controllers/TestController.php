<?php 

namespace app\controllers;
use app\core\Request;
use app\utility\Csrf;
use app\utility\Validate;
use Helper;

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

        $valid = $validate->validator([
            // 'firstName'=> 'required',
            'name'=> 'required',
            'email' => 'email|required',
            // 'password'=>'maxLen:10|required'
            
        ]);
        
        // dd($valid);
        if(!$valid){            
            return Helper::redirect('teste');
        }

        // dd($valid, "validaded");
        
        // dd("TestControlle -> ok");
    }

}//end 