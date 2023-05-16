<?php 

namespace app\core;

use app\routes\Routes;
use app\utility\RequestType;
use app\utility\Uri;

class GettingParams
{
    private string $uri;
    private string $method;
    private array $params = [];
    
    public function get($router)
    {   
        //Array search encontra o conteudo dentro do array e retorna a chave (index) que vai se a URI

        //Esse metodo, irá comparar o que é igual e ignorar o que for diferente e retornar
        //Exemplo user/[0-9]+ e user/12 ele irá ignorar o user e retornara o 12;

        $this->uri = Uri::get();
        $this->method = RequestType::get();

        $indexRouter = array_search($router, Routes::get()[$this->method]);

        $explodeUri = explode('/', $this->uri);
        $explodeRouter = explode('/', $indexRouter);

        foreach($explodeRouter as $index => $segment)
        {
            if($segment !== $explodeUri[$index])
            {
                $this->params[$index] = $explodeUri[$index];
            }
            
        }

        //Array values vai deixar no index 0, controller sera resgatará do index 0;
        return array_values($this->params);
    }

}//end class