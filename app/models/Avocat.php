<?php

namespace App\Models;

 class Avocat extends Personnes{
    private string $specialite;
    private bool $consoltation_en_ligne ;

  



 public function getId(){
     return $this->id;
}
 public function getNom(){
     return $this->nom;
}
 public function getEmail(){
     return $this->email;
}
 public function getVille_id(){
     return $this->ville_id;
}
 public function getYears_of_experience(){
     return $this->years_of_experience;
}
 public function getSpecialite(){
     return $this->specialite;
}
 public function getConsoltation_en_ligne(){
     return $this->consoltation_en_ligne;
}





 }