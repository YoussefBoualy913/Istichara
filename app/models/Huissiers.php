<?php

namespace  App\Models;

 class Huissiers extends Professionnelle{
    private string $types_actes;
    

    public function getTypes_actes() :string{
        return $this->types_actes;
    }

    public function setTypes_actes($types_actes) :void{
        $this->types_actes = $types_actes;
    }
         
    public function hydrate(array $data){
        $this->id = $data["user_id"];
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->types_actes = $data['types_actes'];
        $this->years_of_experience = $data['years_of_experience'];
        $this->role = $data['role'];
        $this->password = $data["password"];
        $this->ville_id = $data["ville_id"];
        $this->ville_name = $data["ville_name"];
        $this->status = $data["statut"];
        $this->document = json_decode($data["document"], true);
    }
}