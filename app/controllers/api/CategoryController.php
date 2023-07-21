<?php 
namespace app\controllers\api;

use app\core\Request;

class CategoryController
{
    public function index(){

        dd("teste category api", Request::all());
    }
}