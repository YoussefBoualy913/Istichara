<?php
namespace App\Controller;
use App\Helper\View;

class ControllerVisiteur {

    public function __construct() {}

     public function index(){
        View::render('visiteur.php');
    }
        
    public function register(){
        View::render('register.php');
    }
}