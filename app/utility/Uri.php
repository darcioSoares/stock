<?php 

namespace app\utility;

class Uri 
{   
    //pegando a uri parseando, PHP_URL_PATH e um parametro da funcao parse_url
    //retorna somente a uri, se tiver query string ou algo assim não vem
    public static function get()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    }

}//end class