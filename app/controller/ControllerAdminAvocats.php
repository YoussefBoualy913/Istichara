<?php
namespace App\Controller;

class ControllerAdminAvocats{

     public function show(){
        require_once(__DIR__.'/../../src/views/avocats.php');
     }
}