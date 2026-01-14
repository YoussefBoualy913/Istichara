<?php
 class Router{
    private static array $router ;
  
 public static function get($path,$fille){
    self::$router[$path] = $fille;
//     self::$router = [
//     'dachbord' => '/../../views/admin_dashboard.php',
//     'create' => '/../../views/create.php'
// ];
 }

public static function dispatsh($url){
    
   if(array_key_exists($url,self::$router)){
    require_once(__DIR__.self::$router[$url]);
   }else{
    echo "404";
   }
 }



 

    
}
 