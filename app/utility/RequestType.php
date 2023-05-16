<?php

namespace app\utility;

class RequestType 
{
    //transforma o metodo em minusculo, exemplo GET vira get 
    public static function get()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

}//end class


