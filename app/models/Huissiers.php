<?php

namespace  App\Models;

 class Huissiers extends Personnes{
    private string $types_actes;
 




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
 public function getTypes_actes(){
     return $this->types_actes;
}


}