<?php


namespace Tanis\Controllers;

use Tanis\Database\Managers\EntityManager;
use Tanis\Models\Category;

class CategoryController
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct()
    {
        $this->em = new EntityManager();
    }

    public function getCategories()
    {
        return $this->em->getCategories();
    }

    public function storeCategory()
    {
        $category = new Category([
            'id' => isset($_POST['id']) ?? '',
            'name' => $_POST['name']
        ]);
        return $this->em->insert($category);
    }

    public function getCategoryBrands($catId)
    {
        return $this->em->getCategoryBrands($catId);
    }

}