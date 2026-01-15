<?php

 class Router{
    private static array $router ;
  
 public static function get($path,$fille){
    
    self::$router[$path] = $fille;
    
 }
 public static function dispatsh($url){
       
    
   if(array_key_exists($url,self::$router)){
    
    $controller = self::$router[$url][0];
    $method = self::$router[$url][1];
    (new $controller())->$method();

   }else{
    echo "404";
   }
 }
 




    
}
 