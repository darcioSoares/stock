<?php 

namespace app\utility;

use app\traits\Validations;
use Exception;

class Validate
{
    use Validations;

    public function validator(array $data)
    {        
        $inputsValidation = [];
        foreach($data as $nameField => $validation){          
            //str_contains aparti do php8 -> substr_count tmb chegaria ao resultado
            $havePipes = str_contains($validation, '|');
            
            //se não existir | e validaçao unica ex required
            if(!$havePipes)
            {
                $param = '';
                //ex maxLen:10  maxLen = methodo 10 = param
                if(substr_count($validation, ':') == 1)
                {
                    list($validation, $param) = explode(':', $validation);
                }

                //o this representa a propria class, buscando o metodo na trait que foi add a classe
                //e verificando sua existencia
                if(!method_exists($this, $validation))
                    throw new Exception("O método {$validation} da validação não existe");

                //retornando resultado da validação para esse array
                $inputsValidation[$nameField] = $this->$validation($nameField,$param);

            }else{//validação coposta ex required|email
                
                $validations = explode('|', $validation);
                $param = '';
                foreach($validations as $validation){

                    if(substr_count($validation, ':') == 1){
                        //ex maxLen:10  maxLen = methodo 10 = param
                        [$validation, $param] = explode(":",$validation);
                    }

                    if(!method_exists($this, $validation)){
                        throw new Exception("o método {$validation} não existe na validação");
                    }

                    $inputsValidation[$nameField] = $this->$validation($nameField,$param);

                    // var_dump($inputsValidation[$nameField]);
                    //validando, se retorna null ou false, validação invalida.
                    if(empty($inputsValidation[$nameField]))
                        break;
                }           
            }
        }

        

    }//end method

}//end class