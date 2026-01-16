<?php

namespace  App\Models;

 class Huissiers extends Personnes{
    private string $types_actes;
 





 public function getTypes_actes(){
     return $this->types_actes;
}


}