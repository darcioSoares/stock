<?php 

namespace app\controllers;

use App\models\Categories;
use app\models\Category;

Class CategoryController extends Controller
{
    public function index()
    {
        $category = new Category();
        $categories = $category->all();
                
        $this->view('categories', compact('categories'));
    }
    
}