<?php


namespace Tanis\Controllers;

use Tanis\Database\Managers\EntityManager;
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

    public function __construct($json)
    {
        $this->json->$json;
        $this->entityManager = new EntityManager();
    }

    public function processFile()
    {
        $jsonIterator = new \RecursiveIteratorIterator(
            new \RecursiveArrayIterator(json_decode(file_get_contents($_FILES['file']['tmp_name']), TRUE)),
            \RecursiveIteratorIterator::SELF_FIRST);

        foreach ($jsonIterator as $key => $val) {
            switch ($jsonIterator->getDepth()) {
                case 0:
                    if ($key == 'categories') {
                        foreach ($val as $index => $category) {
                            $this->entityManager->insert(new Category($category));
                        }
                    }
                case 2:
                    if ($key == 'products') {
                        foreach ($val as $index => $product) {
                            $this->entityManager->insert(new Category($category));
                        }
                    }
            }
        }
    }
}