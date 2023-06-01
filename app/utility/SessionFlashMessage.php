<?php 

namespace app\utility;

class SessionFlashMessage
{
    public static function set(string $index, string $value)
    {
        if(!isset($_SESSION[$index])){
            $_SESSION[$index] = $value;
        }
    }

    //verificando existencia do valor e setando a uma var e apagando a sessão
    public static function get(string $index){

        if(isset($_SESSION[$index])){
            $value = $_SESSION[$index];

            unset($_SESSION[$index]);

            return $value;
        }
       return false; 
    }

}//end class