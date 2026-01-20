<?php

namespace App\Models;

 class Avocat extends Professionnelle{
    private string $specialite;
    private bool $consoltation_en_ligne ;

  

 public function getSpecialite():string{
     return $this->specialite;
}
public function getConsoltation_en_ligne():string{
    return $this->consoltation_en_ligne;
}
public function setSpecialite($specialite):void{
    $this->specialite = $specialite;
}
public function setconsoltation_en_ligne($consoltation_en_ligne):void{
     $this->consoltation_en_ligne = $consoltation_en_ligne;
}




 }