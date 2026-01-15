<?php
namespace App\Helper;
use PDO;
use PDOException;
 class Database {
    private static string $host = "localhost";
    private static string $database = "ApexMercatoe";
    private static string $username = "root";
    private static string $password = "";
    private static  ?PDO $pdo;

    

 public static function getConnexion()
    {
       if (!self::$pdo){
        try{

         self::$pdo = new PDO("mysql:host={".self::$host."};dbname={".self::$database."}",self::$username,self::$password);
         self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
         self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        }catch(PDOException $e){
             die("Erreur de connexion : " . $e->getMessage());
        }
       }
       return self::$pdo;
  
}

 }