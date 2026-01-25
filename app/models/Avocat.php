<?php

namespace App\Models;

 class Avocat extends Professionnelle{
    private string $specialite;
    private bool $consoltation_en_ligne;

    public function getSpecialite():string{
        return $this->specialite;
    }

    public function getConsoltation_en_ligne():string{
        return $this->consoltation_en_ligne;
    }
   
    public function setSpecialite($specialite):void{
        $this->specialite = $specialite;
    }
    
    public function setconsoltation_en_ligne($consoltation_en_ligne):void{
        $this->consoltation_en_ligne = $consoltation_en_ligne;
    }
             
    public function hydrate(array $data){
        $this->id = $data["user_id"];
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->consoltation_en_ligne = $data['consultation_en_ligne'];
        $this->specialite = $data['specialite'];
        $this->years_of_experience = $data['years_of_experience'];
        $this->role = $data['role'];
        $this->password = $data["password"];
        $this->ville_id = $data["ville_id"];
        $this->ville_name = $data["ville_name"];
        $this->status = $data["statut"];
        $this->document = json_decode($data["document"], true);
    }
}