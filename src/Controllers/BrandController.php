<?php


namespace Tanis\Controllers;

use Tanis\Http\Response;

class BrandController extends BaseController
{
    /**
     * @var string
     */
    public $table = 'brands';

    public function get($id = null)
    {
        $response = new Response(json_encode([
            'items' => $this->getEm()->getBrandProducts($id)
        ]), 200);
        $response->send();
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

}