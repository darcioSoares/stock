<?php 

session_start(['name'=>'stock']);
// Define o tempo de vida da sessão para 30 minutos
ini_set('session.gc_maxlifetime', 1800);

require '../vendor/autoload.php';

use Dotenv\Dotenv;

    // teste
use app\routes\Routes;
use app\utility\RequestType;
use app\utility\Uri;
use app\core\FilterRoute;
use app\core\Request;
use app\core\Router;

//config dotenv
$path = dirname(__FILE__,2);
$dotenv = Dotenv::createImmutable($path);
$dotenv->load();


//config timezone
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.uft-8','portuguese');

//pastaInterna, caso coloque dentro de outra pasta ex public/asset/ ao inves de só public
$pastaInterna = "";
//PATH_PUBLIC pegando a url da aplicação, já esta na raiz dentro da pasta public
define('PATH_PUBLIC', "http://{$_SERVER['HTTP_HOST']}/{$pastaInterna}");




                              //teste
//Helper::teste();

// dd($_SERVER);
// dd(Request::all(), $_POST['data']);
// dd(Routes::get());
//dd(RequestType::get());
//dd(Uri::get());

// $filterRoute = new FilterRoute();
// dd($filterRoute->get() );

// dd(Router::run());

Router::run();
