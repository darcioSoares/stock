<?php 

namespace app\routes;

class Routes {

    public static function get()
    {
        return [
            "get" => [
                "/" => 'LoginController@index',
                "/login" => 'LoginController@index',
                "/teste" => 'TestController@index',
                "/home" => 'HomeController@index',
                "/users" => 'UserController@index',
                "/user/[0-9]+" => 'UserController@index',              
                "/teste/[0-9]+" => 'HomeController@teste',
                "/teste/[a-z]+/sobrenome/[a-z]+" => 'HomeController@teste1',
            ],
            "post" => [
                "/teste" => 'TestController@teste',
                "/login" => 'LoginController@login',
                '/create-user' => 'api\UserController@create'
            ]
        ];
    }

}//end class