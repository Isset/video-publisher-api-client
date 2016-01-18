<?php

namespace VideoPublisher;

use VideoPublisher\Domain\Stream;
use VideoPublisher\Domain\SimpleStream;
use VideoPublisher\Connection\Curl\CurlPost;
use VideoPublisher\Connection\ConnectionInterface;
use VideoPublisher\Authentication\Authentication;
use VideoPublisher\Exception\BadResponseException;
use VideoPublisher\Exception\StreamNotFoundException;
use VideoPublisher\Exception\TokenCacheNotWritableException;
use VideoPublisher\Security\TokenVault;
use VideoPublisher\Payload\PayloadFactory;

/**
 * Class VideoPublisherClient.
 *
 * @author Bart Malestein <bart@isset.nl>
 */
class VideoPublisherClient
{
    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var ConnectionInterface - Class responsible for sending of payloads
     */
    private $connection;

    /**
     * @var PayloadFactory - Factory that can create payloads
     */
    private $payloadFactory;

    /**
     * @var Authentication - Class responsible for authentication
     */
    private $authentication;

    /**
     * VideoPublisherClient constructor.
     *
     * @param Authentication $authentication - Your preferred authentication, default KeyPairAuthentication
     * @param string $tokenCacheLocation - Your preferred token location on disk. This can be any folder, but make sure the application has sufficient rights.
     * @param string $baseUrl - http://my.videopublisher.io/
     * @param ConnectionInterface $connection - Your preferred connection handler, defaults to CurlPost
     *
     * @throws TokenCacheNotWritableException
     */
    public function __construct(Authentication $authentication, $tokenCacheLocation, $baseUrl = 'http://my.videopublisher.io/', ConnectionInterface $connection = null)
    {
        $this->baseUrl = $baseUrl;
        $this->authentication = $authentication;
        $this->payloadFactory = new PayloadFactory(rtrim($this->baseUrl, '/'));

        if ($connection === null) {
            $this->connection = new CurlPost();
        } else {
            $this->connection = $connection;
        }

        $authentication->injectServices($this->connection, new TokenVault($tokenCacheLocation), $this->payloadFactory);
    }

    /**
     * Returns a list of al your published streams, with basic information.
     *
     * @return SimpleStream[]
     * @throws BadResponseException
     */
    public function listStreams()
    {
        $token = $this->authentication->getToken();
        $payload = $this->payloadFactory->get('/api/published');
        $payload->setHeader($token->getName(), $token->getValue());
        $response = $this->connection->sendPayload($payload);
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            $simpleStreams = [];
            foreach ($response->getJsonResponse() as $item) {
                $simpleStreams[] = new SimpleStream($item);
            }

            return $simpleStreams;
        }
        throw new BadResponseException;
    }


    /**
     * Returns a stream, based on Uuid. Contains basic information and playout url / video player
     *
     * @param string $uuid
     * @return Stream
     * @throws StreamNotFoundException
     */
    public function getStream($uuid)
    {
        $token = $this->authentication->getToken();
        $payload = $this->payloadFactory->get(sprintf('/api/publish/%s', $uuid));
        $payload->setHeader($token->getName(), $token->getValue());
        $response = $this->connection->sendPayload($payload);
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            return new Stream($response->getJsonResponse());
        } else {
            throw new StreamNotFoundException('No stream found with uuid: ' . $uuid);
        }
    }

}