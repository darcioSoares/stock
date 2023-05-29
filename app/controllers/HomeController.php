<?php 

namespace app\controllers;
use app\core\Request;

class HomeController extends Controller
{
    public function index()
    {       
        $this->view('home');
    }

    public function teste($params)
    {
        $this->view('teste');
        // dd("teste -> homeController", "");
    }

    public function teste1($params)
    {
        dd("teste -> ", $params, Request::queryAll());
    }

    public function teste2($params)
    {
        $nome = 'darcio de sousa';
        //$this->view('home',["nome"=>"darcio"]);
        $this->view('home',compact('nome'));

    }

    public function store($params)
    {

        dd(Request::excepts(['age','name']));

    }
}