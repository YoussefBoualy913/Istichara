<?php

namespace App\Helper;

class Validator{
    
    public function isValidEmail(mixed $value): bool {
        if(!$value || !trim($value)) return false;
        return filter_var($value, FILTER_VALIDATE_EMAIL) ? trim($value) : null;
    }

    public function isValidString(mixed $value){
        if(!$value || !trim($value)) return false;
        return is_string($value) ? trim($value) : null;
    }

    public function isValidPassword(string $password, string $hash){
        return password_verify($password, $hash) ? trim($password) : null;
    }
}
