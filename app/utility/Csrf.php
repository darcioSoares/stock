<?php 

namespace app\utility;

use app\core\Request;
use Exception;

class Csrf 
{
    public static function generatorCsrf()
    {
        if(isset($_SESSION['token']))
          unset($_SESSION['token']);
        
        $_SESSION['token'] = md5(uniqid());

        return "<input type='hidden' name='token' value='{$_SESSION['token']}'>";
    }        

    public static function validatorCsrf()
    {
        if(!isset($_SESSION['token']))
            throw new Exception('Token invalido');

            $token = Request::input('token');  
                   
            //empty($token) por q se o form não tiver o csrf estava retornando [] vazio
            if(empty($token) || $_SESSION['token'] != $token)
                throw new Exception('Token invalido');

        return true;
    }

}//end class