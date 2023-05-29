<?php

class Helper
{

    public static function teste()
    {
        dd("testando helpers");
    }

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




}// end class