<?php 

namespace app\routes;

class Routes {

    public static function get()
    {
        return [
            "get" => [
                "/" => 'LoginController@index',
                
                "/teste" => 'HomeController@teste2',
                "/teste/[0-9]+" => 'HomeController@teste',
                "/teste/[a-z]+/sobrenome/[a-z]+" => 'HomeController@teste1',
                "/user/[0-9]+" => 'UserController@index'
            ],
            "post" => [
                "/teste" => 'HomeController@store',
                "/login" => 'LoginController@login'
            ]
        ];
    }

}//end class