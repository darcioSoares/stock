<?php 

namespace app\core;

class Request 
{
    public static function input(string $name)
    {
        if(isset($_POST[$name]))
        {
            return $_POST[$name];
        }else{
            return $_POST[$name] = false;
        }

    }//end method

    public static function all()
    {
        return $_POST;

    }//end method

    public static function excepts($excepts)
    {
        $post = self::all();

        if(is_array($excepts))
        {
            foreach($excepts as $index => $value)
            {
                unset($post[$value]);
            }        
        }

        if(is_string($excepts))
        {
                unset($post[$excepts]);
        }

        return $post;

    }//end method

    public static function query(string $name)
    {
        if(isset($_GET[$name]))
        {
            return $_GET[$name];
        }else{
            return $_GET[$name] = false;
        }

    }//end method

    public static function queryAll()
    {
        if(empty($_GET))
        {
            return false;
        }
        return $_GET;

    }//end method

}//end class