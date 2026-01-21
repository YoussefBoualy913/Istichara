<?php


namespace App\Helper;

final class FileUploader {
    private string $basePath;
    private int $maxSize;
    private array $allowedMimeTypes;

    public function __construct( string $basePath, int $maxSize = 10_000_000, array $allowedMimeTypes = ['image/jpeg', 'image/png','application/pdf']) {
        $this->basePath = rtrim($basePath, '/');
        $this->maxSize = $maxSize;
        $this->allowedMimeTypes = $allowedMimeTypes;
    }

    public function store(array $file) {
        if (!$this->isValidUpload($file)) return null;
        if (!is_dir($this->basePath) && !mkdir($this->basePath, 0755, true)) return null;

        $extension = match (mime_content_type($file['tmp_name'])) {
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'application/pdf' => 'pdf',
            default => null
        };

        if ($extension === null) return null;
        $filename = bin2hex(random_bytes(16)) . '.' . $extension;
        $destination = $this->basePath . '/' . $filename;

        if (!move_uploaded_file($file['tmp_name'], $destination)) return null;
        return $filename;
    }

    private function isValidUpload(array $file) {
        if (!isset($file['tmp_name'], $file['size'], $file['error']) || $file['error'] !== UPLOAD_ERR_OK) return false;
        if ($file['size'] <= 0 || $file['size'] > $this->maxSize) return false;

        $mime = mime_content_type($file['tmp_name']);
        return in_array($mime, $this->allowedMimeTypes, true);
    }
}
