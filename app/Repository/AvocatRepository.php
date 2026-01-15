<?php
use App\Repository\BaseRepositry;
use App\Models\Avocat;
use App\Helper\Database;

class AvocatRepository extends BaseRepositry{
   private PDO  $pdo ;

   public function __construct()
   {
   $this->pdo = Database::getConnexion();
   }
   
   

   


   }