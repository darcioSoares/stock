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

        $this->view('users',compact('users'));
    }

}