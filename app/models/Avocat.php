<?php

namespace App\Models;

 class Avocat extends Personnes{
    private string $specialite;
    private bool $consoltation_en_ligne ;

  

 public function getSpecialite(){
     return $this->specialite;
}
 public function getConsoltation_en_ligne(){
     return $this->consoltation_en_ligne;
}





 }