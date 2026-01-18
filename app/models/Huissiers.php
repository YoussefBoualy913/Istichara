<?php

namespace  App\Models;

 class Huissiers extends Personnes{
    private string $types_actes;
 

 public function getTypes_actes(){
     return $this->types_actes;
}
 public function setTypes_actes($types_actes){
     return $this->types_actes = $types_actes;
}


}