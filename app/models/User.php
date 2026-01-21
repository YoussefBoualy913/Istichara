<?php
namespace App\Models;

abstract class User{
     protected int $id;
     protected string $name;
     protected string $email;
     protected string $role;
     protected string $password;

     
     public function getId():int {
          return $this->id;
     }

     public function getName():string{
          return $this->name;
     }

     public function getEmail():string{
          return $this->email;
     }

     public function getRole():string{
          return $this->name;
     }

     public function getPassword():string{
          return $this->email;
     }

     public function setId($id):void {
          $this->id = $id;
     }
     
     public function setName($name):void{
          $this->name = $name;
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