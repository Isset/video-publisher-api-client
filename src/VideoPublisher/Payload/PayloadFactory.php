<?php

namespace VideoPublisher\Payload;

/**
 * Class PayloadFactory.
 *
 * @author Bart Malestein <bart@isset.nl>
 */
class PayloadFactory
{
    /**
     * @var string
     */
    private $baseUrl;

    /**
     * PayloadFactory constructor.
     * @param string $baseUrl
     */
    public function __construct($baseUrl)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    /**
     * @param string $path
     * @return Payload
     */
    public function post($path)
    {
        return $this->createPayload($path, 'post');
    }

    /**
     * @param string $path
     * @return Payload
     */
    public function put($path)
    {
        return $this->createPayload($path, 'put');
    }

    /**
     * @param string $path
     * @return Payload
     */
    public function get($path)
    {
        return $this->createPayload($path, 'get');
    }

    /**
     * @param string $path
     * @param string $method
     * @return Payload
     */
    public function createPayload($path, $method)
    {
        return new Payload($this->baseUrl . '/' . ltrim($path, '/'), $method);
    }
}