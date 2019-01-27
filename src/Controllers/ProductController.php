<?php


namespace Tanis\Controllers;


class ProductController
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var string
     */
    public $table = 'products';

    public function __construct()
    {
        $this->em = new EntityManager();
    }
}