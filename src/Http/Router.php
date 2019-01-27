<?php


namespace Tanis\Http;

class Router
{
    const HANDLER_NAMESPACE = 'Tanis\Controllers\\';

    public $request;

    public $requestHandler;

    public $requestHandlerAction;

    public function __construct()
    {
        $this->request = new Request();
        $this->requestHandler = $this->setRequestHandler($this->request->getComponent(0));
        $this->requestHandlerAction = $this->getHandlerAction();
    }

    /**
     * @param mixed $requestHandler
     * @return string
     */
    public function setRequestHandler($requestHandler)
    {
        if (isset($requestHandler) && $requestHandler === '') {
            return 'IndexController';
        }

        if (strpos($requestHandler, '-')) {
            $parts = explode('-', $requestHandler);
            $requestHandler = implode('', array_map('ucfirst', $parts));
        }

        return ucfirst($requestHandler) . 'Controller';
    }

    public function getHandlerAction()
    {
        switch ($this->request->getMethod()) {
            case 'GET':
                return 'get';
            case 'POST':
                return 'store';
            case 'PUT':
                return 'update';
            case 'DELETE':
                return 'delete';
            default:
                return 'home';
        }
    }

    public function callAction()
    {

    }

    public function run()
    {
        $class = self::HANDLER_NAMESPACE . $this->requestHandler;
        $controller = new $class;
        return call_user_func_array([
            $controller,
            $this->requestHandlerAction
        ], $this->request->forwardParameters());
    }
}
