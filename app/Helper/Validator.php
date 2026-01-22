<?php

namespace App\Helper;

class Validator{
    
    public function isValidEmail(mixed $value): string | bool {
        if(!$value || !trim($value)) return false;
        if(!filter_var($value, FILTER_VALIDATE_EMAIL)) return false;
        return trim($value);
    }

    public function isValidString(mixed $value): string | null{
        if(!$value || !trim($value)) return false;
        return is_string($value) ? trim($value) : null;
    }

    public function isValidPassword(string $password, string $hash){
        return password_verify($password, $hash) ? trim($password) : null;
    }
}
