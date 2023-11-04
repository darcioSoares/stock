<?php 
namespace app\controllers;

// use App\models\Categories;
use app\models\Category;

Class ProductController extends Controller
{
    public function index()
    {      
        $category = new Category();
        $categories = $category->all();
                
        $this->view('products',compact("categories"));
    }
    
}