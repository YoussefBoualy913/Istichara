<?php

namespace  App\Models;

abstract class Professionnelle extends User{
    protected string $ville_id;
    protected string $ville_name;
    protected int $years_of_experience;
    protected array $document;
    protected string $status;
 

     public function getVille_id():string {
          return $this->ville_id;
     }

     public function getVille_name():string {
          return $this->ville_id;
     }

     public function getYears_of_experience():int {
     return  $this->years_of_experience ;
     }

     public function getDocument() {
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

     public function setDocument(array $document):void {
          $this->document = $document;
     }

     public function setStatus($status):void {
          $this->status = $status;
     }
     
     public function setVille_name($value) {
          $this->years_of_experience = $value ;
     }
}