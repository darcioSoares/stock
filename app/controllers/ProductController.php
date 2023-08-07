<?php 
namespace app\controllers;

// use App\models\Categories;
// use app\models\Category;

Class ProductController extends Controller
{
    public function index()
    {      
                
        $this->view('products');
    }
    
}