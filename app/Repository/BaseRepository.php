<?php

use App\Models\Avocat;
use App\Models\Huissiers;
use App\Models\Personnes;

class BaseRepositry{
   private PDO  $pdo ;

   public function __construct()
   {
   $this->pdo = Database::getConnexion();
   }
   
   public function getALL(string $tablename) :array {
     $stmt = $this->pdo->prepare("select * from".$tablename."");
     $stmt->execute();
     return  $stmt->fetchAll();
   }
   public function dellete(string $tablename,int $id):void{
     $stmt = $this->pdo->prepare("dellete * from".$tablename."where id =?");
     $stmt->execute([$id]);
    
   }

    public function create(Personnes $personnes,$data):void {

    if($personnes instanceof Avocat){
        $keys = array_keys($data);
    $sql ="insert into avocat(".implode(',',$keys).") valus(:".implode(",:",$keys).")";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);

    }
     if($personnes instanceof Huissiers ){
        $keys = array_keys($data);
    $sql ="insert into Huissiers(".implode(',',$keys).") valus(:".implode(",:",$keys).")";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);

    }

   }


   }