<?php 
namespace App\Repository\RepositoryInterface;
use App\Models\Professionnelle;

interface RepositoryInterface {
     public function getAll(): array | bool;
     public function update(array $user, array $pro = []): bool;
     public function create(array $user, array $pro = []): bool;
     public function findById(int $id): array | bool;
}