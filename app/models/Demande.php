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

    
}