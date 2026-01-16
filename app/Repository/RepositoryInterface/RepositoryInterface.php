<?php 
namespace App\Repository\RepositoryInterface;
use App\Models\Personnes;

interface RepositoryInterface {
     public function getAll(string $tablename);
     public function updete(Personnes $personnes);
     public function delete(string $tablename,int $id);
     public function findById(string $tablename,int $id);
     public function create(array $data,string $tablename);
   
 
}