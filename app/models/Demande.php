<?php 
namespace App\models;

use DateTime;

class Demande {

    private int $id;
    private int $user_id;
    private int $avocat_id;
    private int $huissier_id;
    private DateTime $date;
    private string $validation_status;
    private string $meet_link ; 


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

   
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

    }


    public function getAvocat_id()
    {
        return $this->avocat_id;
    }

   
    public function setAvocat_id($avocat_id)
    {
        $this->avocat_id = $avocat_id;

    }

  
    public function getHuissier_id()
    {
        return $this->huissier_id;
    }

   
    public function setHuissier_id($huissier_id)
    {
        $this->huissier_id = $huissier_id;

    }

    
    public function getDate()
    {
        return $this->date;
    }

    
    public function setDate($date)
    {
        $this->date = $date;
 
    }

   
    public function getValidation_status()
    {
        return $this->validation_status;
    }

    
    public function setValidation_status($validation_status)
    {
        $this->validation_status = $validation_status;

    }

    
    public function getMeet_link()
    {
        return $this->meet_link;
    }

   
    public function setMeet_link($meet_link)
    {
        $this->meet_link = $meet_link;

    }
}