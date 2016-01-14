<?php

namespace VideoPublisher\Connection\Curl;

use VideoPublisher\Payload\Payload;
use VideoPublisher\Connection\ConnectionInterface;
use VideoPublisher\Connection\ConnectionException;

/**
 * Class CurlPost.
 *
 * @author Bart Malestein <bart@isset.nl>
 */
class CurlPost implements ConnectionInterface
{

    /**
     * @var int
     */
    private $curlOptConnectionTimeOut;

    /**
     * @var int
     */
    private $curlOptTimeOut;

    /**
     * CurlPost constructor.
     *
     * @param int $curlOptConnectionTimeOut
     * @param int $curlOptTimeOut
     */
    function __construct($curlOptConnectionTimeOut = 2, $curlOptTimeOut = 8)
    {
        $this->curlOptConnectionTimeOut = $curlOptConnectionTimeOut;
        $this->curlOptTimeOut = $curlOptTimeOut;
    }

    /**
     * @param Payload $payload
     * @return CurlResponse
     * @throws ConnectionException
     */
    public function sendPayload(Payload $payload)
    {
        $ch = curl_init($payload->getUrl());
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->curlOptConnectionTimeOut);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->curlOptTimeOut);
        
        if (in_array($payload->getMethod(), [
            'post',
            'put'
        ])) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload->getPostData()));
        }

        $headers = $payload->getHeaders();
        if (false === empty($headers)) {
            $curlHeaders = array();
            foreach ($headers as $key => $value) {
                $curlHeaders[] = $key . ': ' . $value;
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaders);
        }

        $content = curl_exec($ch);
        if ($content === false) {
            throw new ConnectionException();
        }
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $retHeaders = substr($content, 0, $header_size);
        $body = substr($content, $header_size);
        
        return new CurlResponse(curl_getinfo($ch, CURLINFO_HTTP_CODE), $retHeaders, $body);
    }
}