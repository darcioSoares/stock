<?php

use app\utility\Csrf as UtilityCsrf;

class Csrf
{
    //para gerar dentro da view
    public static function csrf()
    {
       return UtilityCsrf::generatorCsrf();
    }//end 
}