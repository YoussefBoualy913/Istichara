<?php


namespace App\Helper;


class Session {
    private const USERKEY = "USER_ID";
    
    public function Start(){
        if(session_status() !== PHP_SESSION_ACTIVE) session_start();
    }

    public function setUserId(int $userId){
        $_SESSION[self::USERKEY] = $userId;
        session_regenerate_id();
    }
    
    public function getUserId(){
        return isset($_SESSION[self::USERKEY]) ? $_SESSION[self::USERKEY] : null;
    }
    
    public function clearUser(){
        unset($_SESSION[self::USERKEY]);
        session_regenerate_id(true);
    }
}
