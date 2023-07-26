<?php 

namespace app\models;

use app\models\Model;
use Exception;
use PDO;
use PDOException;

class Category extends Model
{
    private $table = 'categories';

    public function create(array $data):array
    {
        try{           
   
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("INSERT INTO $this->table(name, segment) VALUES(:NAME,:SEGMENT)");
          
                
            $stmt->bindParam(":NAME",$data['name']);
            $stmt->bindParam(":SEGMENT",$data['segment']);
                                                
            $stmt->execute();           
            $this->conn->commit(); 
                       
            if($stmt->rowCount() == 0 ){
                return ["status"=> false];
            }else{
                return ["status"=> true,"row"=>$stmt->rowCount()];
            }
                 
    
        }catch(PDOException $e){
            $this->conn->rollback();
            echo 'Error database: ' . $e->getMessage();
        }catch(Exception $e){
            $this->conn->rollback();
            echo 'Error: ' . $e->getMessage();
        }

    }//method create

    public function thereIsEmail(string $name)
    {   
        try{

            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("SELECT name FROM $this->table WHERE NAME = :NAME");
                
            $stmt->bindParam(":NAME",$name);
                                    
            $stmt->execute();
            $this->conn->commit(); 

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


            if(count($results) == 0){
                return ["status"=> false, 'msg'=>'Nome não encontrado'];
            }else{     
                $results[0]['status'] = true;        
                return $results[0];
            }

        }catch(PDOException $e){
            $this->conn->rollback();
            echo 'Error database: ' . $e->getMessage();
        }catch(Exception $e){
            echo 'Error: ' . $e->getMessage();
        }

    }//end method

    

    public function all():array
    {
        try{          
                              
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("SELECT id, name, segment FROM $this->table");
                                            
            $stmt->execute();            
            $this->conn->commit(); 
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(count($results) == 0){
                return ["status"=> false];
            }else{   
                return $results;
            }         
    
        }catch(PDOException $e){
            $this->conn->rollback();
            echo 'Error database: ' . $e->getMessage();
        }catch(Exception $e){
            echo 'Error: ' . $e->getMessage();
        }


    }//end method


}//end class