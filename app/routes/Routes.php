<?php 

namespace app\routes;

class Routes {

    public static function get()
    {
        return [
            "get" => [
                "/" => 'LoginController@index',
                "/login" => 'LoginController@index',
                
                "/home" => 'HomeController@index',
                "/users" => 'UserController@index',
                "/user/[0-9]+" => 'UserController@index',

                "/teste/teste" => 'HomeController@index',
                "/teste/[0-9]+" => 'HomeController@teste',
                "/teste/[a-z]+/sobrenome/[a-z]+" => 'HomeController@teste1',
            ],
            "post" => [
                "/teste" => 'HomeController@store',
                "/login" => 'LoginController@login',
                '/create-user' => 'UserController@create'
            ]
        ];
    }

}//end class