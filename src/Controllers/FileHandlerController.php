<?php


namespace Tanis\Controllers;

use Tanis\Database\Managers\EntityManager;
use Tanis\Http\Response;
use Tanis\Models\Category;

class FileHandlerController
{
    /**
     * @var string
     */
    private $json;

    /**
     * @var EntityManager
     */
    public $entityManager;

    public function __construct()
    {
        $this->entityManager = new EntityManager();
    }

    public function store()
    {
        // make sure the user uploaded the file
        if (!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {

            $response = new Response(json_encode([
                'error' => $_FILES['file']['error']
            ]), 400);

            return $response->send();
        }

        $this->processFile();
    }

    public function processFile()
    {
        $payloads = utf8_encode(file_get_contents($_FILES['file']['tmp_name']));

        $jsonIterator = new \RecursiveIteratorIterator(
            new \RecursiveArrayIterator(json_decode($payloads, TRUE)),
            \RecursiveIteratorIterator::SELF_FIRST);

        foreach ($jsonIterator as $key => $val) {
            switch ($jsonIterator->getDepth()) {
                case 0:
                    if ($key == 'categories') {
                        foreach ($val as $index => $item) {
                            $category = new Category();
                            $category->setName($item['name']);
                            $category->setId($item['id']);
                            $this->entityManager->insert($category);
                        }
                    }
                case 2:
                    if ($key == 'products') {
                        foreach ($val as $index => $product) {
//                            $this->entityManager->insert(new Category($category));
                        }
                    }
            }
        }
    }
}