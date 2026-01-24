<?php

use App\Core\Middleware\Service\MiddlewarePipeline;
use App\Helper\Request;


 class Router{

   private static array $routes;
   private Request $request;
   public function __construct() {
      $this->request = new Request();
   }
   
   public static function add($path,$info){
      self::$routes[$path] = $info;
   }

   public function dispatsh(){
      $requestURL = $this->request->getQuery('url') ?? "/";
      $match = [];
      foreach(self::$routes as $path => $route){
         $regex = "#^" . str_replace("{id}", "(\d+)", $path) . "$#";
         if(preg_match($regex, $requestURL, $match)){
            $match = end($match);
            $callable = $route['callable'];
            $middleWares = $route['middlewares'];

            (new MiddlewarePipeline($middleWares))->handle();

            $controller = explode("@", $callable)[0];
            $method = explode("@", $callable)[1];

            call_user_func([new $controller(), $method], $match);
            break;
         }
      }
   }
}
 