<?php

namespace App\Helper;


class Response {
    public function header($path){
        header("Location: $path");
        exit();
    }
}