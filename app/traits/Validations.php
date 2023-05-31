<?php 

namespace app\traits;

use app\core\Request;

trait Validations 
{
    public function unique()
    {

    }

    public function email()
    {
        
    }

    public function required($nameField)
    {
        $data = Request::input($nameField);

        if(empty($data)){
            return null;
        }
    }

    public function maxLen($nameField, $param)
    {
        $data = Request::input($nameField);

        if(strlen($data) > $param){
            return null;
        }

        dd($data);
    }

}//end trait