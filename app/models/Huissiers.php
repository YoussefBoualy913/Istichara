<?php

namespace  App\Models;

 class Huissiers extends User{
    private string $types_actes;
 

 public function getTypes_actes() :string{
     return $this->types_actes;
}
 public function setTypes_actes($types_actes) :void{
     $this->types_actes = $types_actes;
}


}