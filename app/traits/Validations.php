<?php 

namespace app\traits;

use app\core\Request;
use app\utility\SessionFlashMessage;

trait Validations 
{
    public function unique()
    {

    }

    public function email($nameField)
    {
        if(!filter_input(INPUT_POST,$nameField, FILTER_VALIDATE_EMAIL)){
            SessionFlashMessage::set($nameField, "Campo obrigatorio");
            return null;
        }
        return strip_tags(Request::input($nameField), '<p><b><span><em>');
        
    }

    public function required($nameField)
    {
        $data = Request::input($nameField);

        if(empty($data)){
            SessionFlashMessage::set($nameField, "Campo obrigatorio");
            return null;
        }
        return strip_tags($data, '<p><b><span><em>');
    }

    public function maxLen($nameField, $param)
    {
        $data = Request::input($nameField);

        if(strlen($data) > $param){
            SessionFlashMessage::set($nameField, "Campo obrigatorio");
            return null;
        }

        return strip_tags($data, '<p><b><span><em>');
    }

}//end trait