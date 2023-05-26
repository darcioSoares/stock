<?php 
namespace app\models;

use Exception;
use PDO;
use PDOException;

abstract class Model {

    protected $conn;

    function __construct()
    {
        try{
                      
            $database = $_ENV['DATABASE'];
            $host = $_ENV['HOST'];
            $port = $_ENV['PORT'];
            $username = $_ENV['USERNAME'];
            $password = $_ENV['PASSWORD'];

           //dd("mysql:dbname=$database; host=$host; port=$port ,$username, $password");       
           $this->conn = new PDO("mysql:dbname=$database; host=$host; port=$port" ,$username,$password);
                   
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        }catch(PDOException $e){
            echo 'Error conexao db: ' . $e->getMessage();
        }

    }
   
    public function select()
    {
        try{                       
    
            $stmt = $this->conn->prepare("SELECT * FROM teste");
    
            $stmt->execute();
    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            //$results  = json_encode($results);
    
            return $results;
        
    
        }catch(PDOException $e){
            echo 'Error: ' . $e->getMessage();
        }
        
    }//end method select
    public function insert()
    {
        try{
                    
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("INSERT INTO teste(nome, email) VALUES(:NAME,:EMAIL)");
            
            $name = "maryssssss";
            $email = 'jon@mary';
    
            $stmt->bindParam(":NAME",$name);
            $stmt->bindParam(":EMAIL",$email);
    
            //CASO EU QUISESSE PASSAR UM PARAMENTRO COMO NUMERO, SE NÃO PASSAR NADA VAI COMO STRING
            //$stmt->bindParam(":num",$num, PDO::PARAM_INT);
            
            $stmt->execute();
            $result = $this->conn->lastInsertId();


            $this->conn->commit();    
    
            // $result = $stmt->execute(array(
            //     ':NAME'   => $name,
            //     ':EMAIL' => $email,        
            // ));
    
    
            //$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            //$results  = json_encode($results);
            // echo  $stmt->rowCount();
            // echo  "///////////";
            // //print_r(get_class_methods($stmt));
            
            // echo  "///////////";      
            // echo  "///////////";
            // echo "~~~~~";
            //print_r($stmt->debugDumpParams());
    
            return ["row"=>$stmt->rowCount(),"lastId"=> $result];
    
    
        }catch(PDOException $e){
            $this->conn->rollback();
            echo 'Error database: ' . $e->getMessage();
        }catch(Exception $e){
            echo 'Error: ' . $e->getMessage();
        }
    }//end method insert

    public function updateTeste(){

        try{
                               
            $stmt = $this->conn->prepare("UPDATE teste SET nome = :NAME,email = :EMAIL WHERE id = :ID");
            
            $name = "darcio";
            $email = 'darcio@dss@11';
            $id = "9";
    
            $stmt->bindParam(":NAME",$name);
            $stmt->bindParam(":EMAIL",$email);
            $stmt->bindParam(":ID", $id, PDO::PARAM_INT);
    
            //CASO EU QUISESSE PASSAR UM PARAMENTRO COMO NUMERO, SE NÃO PASSAR NADA VAI COMO STRING
            //$stmt->bindParam(":num",$num, PDO::PARAM_INT);
            
            $stmt->execute();
    
    
            echo  $stmt->rowCount();
            echo  "///////////";
    
            return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        }catch(PDOException $e){
            echo 'Error: ' . $e->getMessage();
        }
    

    }//end update

    public function delete()
    {
        try{
                               
            $stmt = $this->conn->prepare("DELETE FROM teste  WHERE id = :ID");
          
            $id = "6";
    
            $stmt->bindParam(":ID", $id, PDO::PARAM_INT);
    
            //CASO EU QUISESSE PASSAR UM PARAMENTRO COMO NUMERO, SE NÃO PASSAR NADA VAI COMO STRING
            //$stmt->bindParam(":num",$num, PDO::PARAM_INT);
            
            $stmt->execute();
    
            echo  "///////////";
            echo   $stmt->rowCount();
            echo  "///////////";
    
            return (bool) $stmt->rowCount();
    
    
        }catch(PDOException $e){
            echo 'Error: ' . $e->getMessage();
        }
    }
}