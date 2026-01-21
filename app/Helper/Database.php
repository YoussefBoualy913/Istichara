<?php
namespace App\Helper;
use PDO;
use PDOException;
class Database {
private static  ?PDO $pdo = null;

     public static function getConnexion(){
          if (!self::$pdo){
               try{
                    $host = "ep-silent-poetry-ags6ty4x-pooler.c-2.eu-central-1.aws.neon.tech";
                    $db   = "ISTISHARA";
                    $user = "neondb_owner";
                    $pass = "npg_zGVc2On7RSaF";
                    $port = "5432";
                    $dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require";
                    self::$pdo = new PDO($dsn, $user, $pass, [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]);
               } catch(PDOException $e){
                    die("Erreur de connexion : " . $e->getMessage());
               }
          }
          return self::$pdo;
     }

}