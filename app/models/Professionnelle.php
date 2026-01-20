<?php

namespace  App\Models;

 abstract class Professionnelle extends User{
    protected string $ville_id;
    protected int $years_of_experience;
    protected array $document;
    protected string $status;
 

 public function getVille_id():string {
     return $this->ville_id;
}
 public function getYears_of_experience():int {
    return  $this->years_of_experience ;
}

public function getDocument():array {
     return $this->document;
}

public function setVille_id($ville_id):void {
      $this->ville_id = $ville_id;
}
 public function setYears_of_experience($years_of_experience):void {
      $this->years_of_experience = $years_of_experience;
}


 public function getStatus():string {
     return $this->status ;
}

public function setDocument($document):void {
      $this->document = $document;
}
 public function setStatus($status):void {
     $this->status = $status;
}





}