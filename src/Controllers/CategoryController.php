<?php


namespace Tanis\Controllers;

use Tanis\Http\Response;
use Tanis\Models\Category;

class CategoryController extends BaseController
{
    /**
     * @var string
     */
    public $table = 'categories';

    public function get($id = null)
    {
        $items = isset($id) ? $this->getEm()->getCategoryBrands($id) : $this->getEm()->getCategories();
        $response = new Response(json_encode([
            'items' => $items
        ]), 200);
        $response->send();
    }

    public function store($name)
    {
        $category = new Category();
        $category->setName($name);
        $category->setId();
        $responce = new Response(json_encode([
            'category' => $this->getEm()->insert($category)
        ]), 200);

        $responce->send();

    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }
}