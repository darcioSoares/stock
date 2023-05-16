<?php 

require '../vendor/autoload.php';

use Dotenv\Dotenv;

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


// <link rel="stylesheet" href="@php echo PATH_PUBLIC.'css/style.css';@endphp">
//     <link rel="stylesheet" href="{{PATH_PUBLIC}}bootstrap5.3.0/css/bootstrap.css">
