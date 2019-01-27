<?php


namespace Tanis\Http;


class Response
{

    public $headers;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var int
     */
    protected $statusCode;

    public function __construct($content = '', int $status = 200)
    {
        $this->headers = [
            'ContentType' => 'application/json'
        ];
        $this->setContent($content);
        $this->setStatusCode($status);
    }

    public function sendHeaders()
    {
        if (headers_sent()) {
            return $this;
        }

        // headers
        foreach ($this->headers as $name => $value) {
            header($name.': '.$value, false, $this->statusCode);
        }

        // status
        header(sprintf('HTTP/%s %s', $this->version, $this->statusCode), true, $this->statusCode);

        return $this;
    }

    public function sendContent()
    {
        echo $this->content;

        return $this;
    }

    public function setStatusCode(int $code)
    {
        $this->statusCode = $code;

        return $this;
    }

    public function setContent($content)
    {
        if (null !== $content && !\is_string($content) && !is_numeric($content) && !\is_callable(array($content, '__toString'))) {
            throw new \UnexpectedValueException(sprintf('The Response content must be a string or object implementing __toString(), "%s" given.', \gettype($content)));
        }

        $this->content = (string) $content;

        return $this;
    }

    /**
     * Sends HTTP headers and content.
     *
     * @return $this
     */
    public function send()
    {
        $this->sendHeaders();
        $this->sendContent();

        if (\function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        } elseif (!\in_array(\PHP_SAPI, array('cli', 'phpdbg'), true)) {
            static::closeOutputBuffers(0, true);
        }

        return $this;
    }
}