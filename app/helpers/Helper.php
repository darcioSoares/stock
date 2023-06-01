<?php

class Helper
{
    //validação simples chcando se tem campos vazios
    public static function validatorRequestEmpty(array $ar)
    {
        foreach($ar as $value){
             
             if($value == ""){ 
                $ar['validatorError'] = true;
                break;              
             }                        
        }
        return $ar;
    }

    public static function auth()
    {
        return (object) $_SESSION['user'];
    }


    public static function redirect(string $to)
    {
        return header("Location: {$to}");
    }



}// end class