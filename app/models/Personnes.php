<?php
namespace App\Models;

abstract class Personnes{
    protected int $id;
    protected string $nom ;
    protected string $email ;
    protected string $ville;
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
 public function getVille(){
     return $this->ville;
}
 public function getYears_of_experience(){
     return $this->years_of_experience;
}

 public function setId($id){
     return $this->id = $id;
}
 public function setNom($nom){
     return $this->nom = $nom;
}

 public function setEmail($email){
     return $this->email = $email;
}

 public function setVille($ville){
     return $this->ville = $ville;
}

 public function setYears_of_experience($years_of_experience){
     return $this->years_of_experience = $years_of_experience;
}


}
