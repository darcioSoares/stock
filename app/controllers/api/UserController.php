<?php 
namespace app\controllers\api;

use app\controllers\Controller;
use app\core\Request;
use app\models\User;

class UserController extends Controller
{

    public function create()
    {    
        $resulValidation = \Helper::validatorRequestEmpty(Request::all());

        if(isset($resulValidation['validatorError']))
        {            
            echo json_encode(["status"=>false,"msg"=> "Dados Obrigatorios não foram preenchidos"]);
            return;
        }

        $email = Request::all()["email"];       
        $user = new User();
        $thereIsEmail = $user->thereIsEmail($email);
        
        if($thereIsEmail['status'])
        {
            $msg = "Email {$thereIsEmail['email']} ja existe, por favor insira outro email";
            echo json_encode(["status"=>false,"msg"=> $msg]);
            return;
        }

                
        if($_FILES['image']['error'] == 0){
            
            $request = Request::all();

            $openssl = openssl_encrypt(
                $request['password'],
                $_ENV['CIPHER_METHODS'],
                $_ENV['SECRET'],
                0,
                $_ENV['SECRET_2']       
            );  
            $request['password'] = $openssl;

            $user = new User();
            $result = $user->create($request);

            if($result['status']){
                //pegando extensao
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);   
                $id = $result['lastId'];                
                $photo = "$id.$extension";              
                
                $result = move_uploaded_file($_FILES['image']['tmp_name'], dirname(__FILE__,4)."/public/images/user/$photo");

                if($result){
                    $path = "/images/user/$photo";                    
                }else{
                    $path = "/images/user/user.png";
                }              

                $resultPhoto = $user->userPhoto($path,$id);   
                if($resultPhoto['status']){
                    echo json_encode(["status"=>true,"msg"=>"Usuario Criado com Sucesso"]);
                }           
                
            }else{
                echo json_encode(["status"=>false,"msg"=>"erro ao salvar"]);
            }
           
        }else{
            $request = Request::all();
           
            $openssl = openssl_encrypt(
                $request['password'],
                $_ENV['CIPHER_METHODS'],
                $_ENV['SECRET'],
                0,
                $_ENV['SECRET_2']       
            ); 
            $request['password'] = $openssl;
            
            $user = new User();
            $result = $user->create($request);

            if($result['status']){
                echo json_encode(["status"=>true,"msg"=>"Usuario Criado com Sucesso"]);               
            }else{
                echo json_encode(["status"=>false,"msg"=>"Erro ao Criar Usuario"]);
            }
            
        }
    }//end method


}//end class

