<?php


namespace Tanis\Http;


class Request
{
    /**
     * @var array
     */
    private $components;

    /**
     * @var string
     */
    private $method;

    /**
     * @var array
     */
    private $request;

    public function __construct()
    {
        $this->init();
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->request = $_POST;
    }

    public function init()
    {
        $url = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);
        $this->components = $this->parse($url);
    }

    public function parse($url)
    {
        $urlComponents = explode('/', trim($url, '/'));

        return $urlComponents;
    }

    public function forwardParameters()
    {
        if ($this->getMethod() == 'POST') {
            return $this->getRequest();
        }
        if (count($this->components) > 1) {
            array_shift($this->components);
            return $this->components;
        }
        return [];
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param integer $order
     * @return array
     */
    public function getComponent($order)
    {
        return $this->components[$order];
    }

    /**
     * @return array
     */
    public function getRequest(): array
    {
        return $this->request;
    }

}