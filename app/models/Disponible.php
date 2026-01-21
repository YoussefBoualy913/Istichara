<?php 
namespace App\models;


class Disponible {

    private int $id;
    private int $avocat_id;
    private int $huissier_id;
    private array $disponible;

    public function getId():int{
     return $this->id;
   }
   
    public function getAvocat_id():int{
     return $this->avocat_id;
   }
    public function getHuissier_id():int{
     return $this->huissier_id;
   }
    public function getDisponible():array{
     return $this->disponible;
   }

    public function setId():void{
      $this->id;
   }
   
    public function setAvocat_id($avocat_id):void{
      $this->avocat_id;
   }
    public function setHuissier_id($huissier_id):void{
      $this->huissier_id;
   }
    public function setDisponible($disponible):void{
      $this->disponible;
   }
   
   

   
}