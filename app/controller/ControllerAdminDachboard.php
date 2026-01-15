<?php
namespace App\Controller;

class ControllerAdminDachboard{

     public function show(){
        require_once(__DIR__.'/../../src/views/admin_dashboard.php');
     }
}