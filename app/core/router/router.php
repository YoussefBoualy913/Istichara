<?php

use App\Core\Middleware\AuthMiddleware;
use App\Helper\Response;

 class Router{

   private static array $routes;
   
   public static function add($path,$info){
      self::$routes[$path] = $info;
   }

   public static function dispatsh($url){
      if(!in_array($url, array_keys(static::$routes))) (new Response())->header("");
      $routeInfo = static::$routes[$url];
      $callable = $routeInfo['callable'];
      
      $requireAuth = $routeInfo['auth'];
      $roles = $routeInfo['roles'];

      // (new AuthMiddleware())->handle($routeInfo);

      $controller = explode("@", $callable)[0];
      $method = explode("@", $callable)[1];
      (new $controller())->$method();
   }
}
 