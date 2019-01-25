<?php

require __DIR__ . './../vendor/autoload.php';

use Tanis\Controllers\CategoryController;

$categoryManager = new CategoryController();

if (!empty($_POST['name'])) {

    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode([
        'category' => $categoryManager->storeCategory()
    ]);
    exit(0);
}

if (isset($_GET['cat_id'])) {
    header('Content-Type: application/json');
    http_response_code(200);

    echo json_encode([
        'brands' => $categoryManager->getCategoryBrands($_GET['cat_id'])
    ]);
    exit(0);
}

header('Content-Type: application/json');
http_response_code(200);

$d = $categoryManager->getCategories();
echo json_encode([
    'categories' => $categoryManager->getCategories()
]);
exit(0);
