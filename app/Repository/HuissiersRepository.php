<?php
use App\Repository\BaseRepositry;
use App\Models\Avocat;
use App\Helper\Database;

class HuissiersRepositry{
   private PDO  $pdo ;

   public function __construct()
   {
   $this->pdo = Database::getConnexion();
   }
   
   

   

   


   }