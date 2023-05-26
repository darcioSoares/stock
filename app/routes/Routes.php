<?php 

namespace app\routes;

class Routes {

    public static function get()
    {
        return [
            "get" => [
                "/" => 'LoginController@index',
                
                "/teste" => 'HomeController@index',
                "/teste/[0-9]+" => 'HomeController@teste',
                "/teste/[a-z]+/sobrenome/[a-z]+" => 'HomeController@teste1',
                "/user/[0-9]+" => 'UserController@index'
            ],
            "post" => [
                "/teste" => 'HomeController@store',
                "/login" => 'LoginController@login',
                '/create-user' => 'UserController@create'
            ]
        ];
    }

}//end class