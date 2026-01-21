<?php

namespace App\Helper;

class Request {
    public function getRequestType(): string {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getPath(): string {
        return $_SERVER['REQUEST_URI'];
    }

    public function getClearPath(): string {
        return trim(parse_url($this->getPath(), PHP_URL_PATH), "/");
    }

    public function getQuery(string $query): ?string {
        return $_GET[$query] ?? null;
    }

    public function getParam(string $param): string {
        return $_POST[$param] ?? null;
    }

    public function getOrigin(): string {
        return $_SERVER['REMOTE_ADDR'] ?? "UNKNOWN";
    }
}
