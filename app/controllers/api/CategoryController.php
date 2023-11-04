<?php 
namespace app\controllers\api;

use app\core\Request;
use app\models\Category;

class CategoryController
{
    public function create(){
      
       $category = new Category();
       
       $result = json_decode(file_get_contents('php://input'), true);
       $result = $category->create($result);
      
       if($result['status'])
       {            
           echo json_encode(["status"=>true,"msg"=> "Categoria Salva com Sucesso!"]);
           return;        
       }else{
           echo json_encode(["status"=>false,"msg"=> "Error: Não foi possivel salvar a Categoria!"]);
           return;
       }
       
              
    }
}