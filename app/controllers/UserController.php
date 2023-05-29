<?php 

namespace app\controllers;
use app\models\User;
use app\core\Request;

Class UserController extends Controller
{
    public function index()
    {
        $this->view('users');
    }

    
       


}