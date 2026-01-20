<?php
namespace App\Models;

abstract class User{
    protected int $id;
    protected string $nom ;
    protected string $email ;
    protected string $role ;
    protected string $password ;
    
   
public function getId():int {
     return $this->id;
}
 public function getNom():string{
     return $this->nom;
}
 public function getEmail():string{
     return $this->email;
}
public function getRole():string{
     return $this->nom;
}
 public function getPassword():string{
     return $this->email;
}

 public function setId($id):void {
      $this->id = $id;
}
 public function setNom($nom):void{
      $this->nom = $nom;
}

 public function setEmail($email):void{
     $this->email = $email;
}


public function setRole($role):void{
      $this->role = $role;
}
public function setPassword($password):void{
      $this->password = $password;
}


}