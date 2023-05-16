<?php 

namespace app\controllers;

class HomeController
{
    public function index()
    {
        dd("index homeController");
    }

    public function teste($params)
    {
        dd("teste -> homeController", $params);
    }

    public function teste1($params)
    {
        dd("teste -> ", $params);
    }
}