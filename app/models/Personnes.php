<?php
namespace App\Models;

abstract class Personnes{
    protected int $id;
    protected string $nom ;
    protected string $email ;
    protected int $ville_id;
    protected int $years_of_experience;


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
}
