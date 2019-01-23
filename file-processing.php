<?php

require __DIR__ . '/vendor/autoload.php';

use Tanis\Controllers\FileHandlerController;

// make sure the user uploaded the file
if (!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
    header('Content-Type: application/json');
    http_response_code(400);
    echo json_encode([
        'error' => $_FILES['file']['error']
    ]);
    exit(0);
}

$payloads = utf8_encode(file_get_contents($_FILES['file']['tmp_name']));

/** @var FileHandlerController $fileHandler */
$fileHandler = new FileHandlerController($payloads);
$fileHandler->processFile();
