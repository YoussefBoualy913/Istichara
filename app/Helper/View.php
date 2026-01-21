<?php

namespace App\Helper;

class View {
    public static function render(string $path, array $options = []){
        extract($options);
        require_once "./src/views/" . $path;
    }
}