<?php
namespace App\Models;

abstract class Personnes{
    protected int $id;
    protected string $nom ;
    protected string $email ;
    protected int $ville_id;
    protected int $years_of_experience;
}