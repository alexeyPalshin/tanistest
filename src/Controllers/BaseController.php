<?php


namespace Tanis\Controllers;

use Tanis\Http\Response;
use Tanis\Database\Managers\EntityManager;

class BaseController
{
    /**
     * @var EntityManager
     */
    protected $em;


    public function __construct()
    {
        $this->em = new EntityManager();
    }

    /**
     * @return EntityManager
     */
    public function getEm()
    {
        return $this->em;
    }

    public function delete($id)
    {
        $this->em->delete($this->getTable(), $id);
        $response = new Response(json_encode([
            'success' => true
        ]), 200);
        $response->send();
    }
}