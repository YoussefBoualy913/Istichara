<?php

namespace App\Helper;

class View {
    public static function render(string $path, array $options = []){
        (new Session())->Start();
        $user = (new Session())->getUser();
        $options["user"] = $user;
        extract($options);
        require_once __DIR__ . "/../../src/views/" . $path;
    }
}