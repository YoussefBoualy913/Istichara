<?php
namespace App\Controller;


class ControllerVisiteur{

     public function index(){
        
        require_once(__DIR__.'/../../src/views/visiteur.php');
     }

     public function register(){
         require_once (__DIR__.'/../../src/views/register.php');
     }
}