<?php 

session_start(['name'=>'stock']);

require '../vendor/autoload.php';

use Dotenv\Dotenv;
use app\routes\Routes;
use app\utility\RequestType;
use app\utility\Uri;
use app\core\FilterRoute;
use app\core\Router;

//config dotenv
$path = dirname(__FILE__,2);
$dotenv = Dotenv::createImmutable($path);
$dotenv->load();


//config timezone
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.uft-8','portuguese');

//pastaInterna ex caso coloque dentro de outra pasta ex public/asset/ ao inves de só public
$pastaInterna = "";
//PATH_PUBLIC pegando a url da aplicação, ele já esta na raiz dentro da pasta public
define('PATH_PUBLIC', "http://{$_SERVER['HTTP_HOST']}/{$pastaInterna}");

                              //teste
//Helper::teste();

//dd(Routes::get());
//dd(RequestType::get());
//dd(Uri::get());

//$filterRoute = new FilterRoute();
// dd($filterRoute->get() );

// dd(Router::run());

Router::run();
