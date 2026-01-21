<?php 
namespace App\Repository\RepositoryInterface;
use App\Models\Professionnelle;

interface RepositoryInterface {
     public function getAll();
     public function update(array $user, array $pro = []);
     public function create(array $user, array $pro = []);
     public function delete(int $id);
     public function findById(int $id);
   
 
}