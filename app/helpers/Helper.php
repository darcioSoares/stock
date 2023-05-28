<?php

class Helper
{

    public static function teste()
    {
        dd("testando helpers");
    }

    //validação simples chcando se tem campos vazios
    public static function validatorRequest(array $ar)
    {
        foreach($ar as $value){
             
             if($value == ""){ 
                $ar['validatorError'] = true;              
             }                        
        }
        return $ar;
    }




}// end class