<?php

namespace App\Helper;


class Response {
    
    public function header($path){
        header("Location: $path");
        exit();
    }
    public static function json(array $data, int $status = 200): void
{
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

}