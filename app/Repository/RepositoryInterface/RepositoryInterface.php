<?php 
namespace App\Repository\RepositoryInterface;
use App\Models\Professionnelle;

interface RepositoryInterface {
     public function getAll(string $tablename);
     public function updete(Professionnelle $personnes);
     public function delete(string $tablename,int $id);
     public function findById(string $tablename,int $id);
     public function create(array $data,string $tablename);
   
 
}