<?php


namespace App\Helper;


class Session {
    private const USERKEY = "USER_ID";
    private const USERROLE = "USER_ROLE";
    
    public function Start(){
        if(session_status() !== PHP_SESSION_ACTIVE) session_start();
    }

    public function setUser(int $userId, string $userRole){
        $_SESSION[self::USERKEY] = $userId;
        $_SESSION[self::USERROLE] = strtoupper($userRole);
        session_regenerate_id();
    }
    
    public function getUser(): array | null {
        return isset($_SESSION[self::USERKEY]) && isset($_SESSION[self::USERROLE]) ? ["id" => $_SESSION[self::USERKEY], "role"  => $_SESSION[self::USERROLE]] : null;
    }
    
    public function clearUser(){
        unset($_SESSION[self::USERKEY]);
        unset($_SESSION[self::USERROLE]);
        session_regenerate_id(true);
    }
}