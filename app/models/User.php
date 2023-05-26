<?php 

namespace app\models;

use app\models\Model;
use Exception;
use PDO;
use PDOException;

class User extends Model
{
    private $table = 'users';
    // private $columns = ['name','email','password','professional_position','active','path_image','id_responsible','fk_companies'];
    
    public function login(array $data)
    {
        try{           
                $this->conn->beginTransaction();

                $stmt = $this->conn->prepare("SELECT id, email, password, name FROM $this->table WHERE EMAIL = :EMAIL");
                 
                $stmt->bindParam(":EMAIL",$data['email']);
                                       
                $stmt->execute();
                $this->conn->commit(); 

                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
              

                if(count($results) == 0){
                    return ["status"=> false, 'msg'=>'email não encontrado'];
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

    }//end method login

    public function create(array $data)
    {
        try{           
            //estudar para implementar
            // foreach($data as $value => $keys)
            // {
            //     if(!in_array($value, $this->columns))
            //     {
            //         throw new Exception("erro modulo user coluna ". $value." não encontrado");
            //     }
            // }
                    
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("INSERT INTO $this->table(name, email, password,professional_position,id_responsible) VALUES(:NAME,:EMAIL,:PASSWORD,:PROFESSIONAL_POSITION, :ID_RESPONSIBLE)");

            //,id_responsible,fk_companies
            //,:ID_RESPONSIBLE,:FK_COMPANIES
            
            // DEFAULT IMAGEM
            
                
            $stmt->bindParam(":NAME",$data['name']);
            $stmt->bindParam(":EMAIL",$data['email']);
            $stmt->bindParam(":PASSWORD",$data['password']);
            $stmt->bindParam(":PROFESSIONAL_POSITION",$data['professional_position']);
            $stmt->bindParam(":ID_RESPONSIBLE",$_SESSION['user']['id'],PDO::PARAM_INT);
            // $stmt->bindParam(":FK_COMPANIES",$email, PDO::PARAM_INT);
    
                                 
            $stmt->execute();
            $result = $this->conn->lastInsertId();

            $this->conn->commit(); 
            
            if($stmt->rowCount() == 0 ){
                return ["status"=> false];
            }else{
                return ["status"=> true,"row"=>$stmt->rowCount(),"lastId"=> $result];
            }
                 
    
        }catch(PDOException $e){
            $this->conn->rollback();
            echo 'Error database: ' . $e->getMessage();
        }catch(Exception $e){
            echo 'Error: ' . $e->getMessage();
        }

    }//method create

    public function thereIsEmail(string $email)
    {   
        try{

            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("SELECT email FROM $this->table WHERE EMAIL = :EMAIL");
                
            $stmt->bindParam(":EMAIL",$email);
                                    
            $stmt->execute();
            $this->conn->commit(); 

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


            if(count($results) == 0){
                return ["status"=> false, 'msg'=>'email não encontrado'];
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

    public function userPhoto(string $photo, $id)
    {
        try{            
                              
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("UPDATE $this->table SET path_image = :PATH_IMAGE WHERE ID = :ID");
              
            $stmt->bindParam(":PATH_IMAGE",$photo);
            $stmt->bindParam(":ID",$id);
                                 
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
            echo 'Error: ' . $e->getMessage();
        }

    }//end method


}//end class