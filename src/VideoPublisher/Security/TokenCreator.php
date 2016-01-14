<?php

namespace VideoPublisher\Security;

use VideoPublisher\Connection\ConnectionInterface;
use VideoPublisher\Exception\UnableToCreateHashException;
use VideoPublisher\Payload\LoginPayload;
use VideoPublisher\Connection\ResponseException;
use VideoPublisher\Payload\PayloadFactory;

/**
 * Class TokenCreator.
 *
 * @author Bart Malestein <bart@isset.nl>
 */
class TokenCreator
{
    /**
     * @var ConnectionInterface
     */
    private $connection;

    /**
     * @var PayloadFactory
     */
    private $payloadFactory;

    /**
     * TokenCreator constructor.
     * @param ConnectionInterface $connection
     * @param PayloadFactory $payloadFactory
     */
    public function __construct(ConnectionInterface $connection, PayloadFactory $payloadFactory)
    {
        $this->connection = $connection;
        $this->payloadFactory = $payloadFactory;
    }

    /**
     * @param string $consumerKey
     * @param string $privateKey
     * @return Token
     * @throws ResponseException
     * @throws UnableToCreateHashException
     */
    public function requestTokenFromMyIsset($consumerKey, $privateKey)
    {
        $payload = $this->payloadFactory->post('/api/login');

        $time = time();
        $hash = crypt($time . '' . $privateKey . '' . $consumerKey, '$6$rounds=9001$' . $consumerKey . '$');
        if ($hash === '*0' || $hash === '*1') {
            throw new UnableToCreateHashException;
        }

        $payload->setHeader('Content-Type', 'application/json');
        $payload->setPostData('consumer_key', $consumerKey);
        $payload->setPostData('time', $time);
        $payload->setPostData('hash', $hash);

        $response = $this->connection->sendPayload($payload);
        $statusCode = $response->getStatusCode();
        if ($statusCode >= 200 && $statusCode < 300) {
            return new Token($response->getJsonResponse()['token']) ;
        } else {
            throw new ResponseException($response);
        }
    }
}