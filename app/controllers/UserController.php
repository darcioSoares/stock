<?php 

namespace app\controllers;
use app\models\User;
use app\core\Request;

Class UserController extends Controller
{
    public function index()
    {
        $user = new User();

        $users = $user->all();

       

       foreach($users as &$value)
       {
            $id = $value['id'];
            $value['button'] = '<button class="btn" id="$id"> Açao </button>';
       }

    //    dd($users);

        $this->view('users',compact('users'));
    }

    
       


}