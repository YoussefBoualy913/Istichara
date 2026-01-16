<?php
namespace App\Controller;

use App\Repository\AvocatRepository;
class ControllerDeleteAvocat{

     
     public function deleteavocat(){
       $repoavocat = new AvocatRepository();
       $repoavocat->delete('avocat',$_GET['avocat_id']);
       header('location :avocats');
        exit;
     }
}