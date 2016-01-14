<?php

namespace VideoPublisher\Authentication;

use VideoPublisher\Connection\ConnectionInterface;
use VideoPublisher\Connection\ResponseException;
use VideoPublisher\Exception\TokenNotFoundException;
use VideoPublisher\Exception\UnableToCreateHashException;
use VideoPublisher\Payload\PayloadFactory;
use VideoPublisher\Security\Token;
use VideoPublisher\Security\TokenCreator;
use VideoPublisher\Security\TokenVault;

/**
 * Class KeyPairAuthentication.
 *
 * @author Bart Malestein <bart@isset.nl>
 */
class KeyPairAuthentication implements Authentication
{
    /**
     * @var string
     */
    private $consumerKey;

    /**
     * @var string
     */
    private $privateKey;

    /**
     * @var ConnectionInterface
     */
    private $connection;

    /**
     * @var TokenVault
     */
    private $tokenVault;

    /**
     * @var PayloadFactory
     */
    private $payloadFactory;

    /**
     * KeyPairAuthentication constructor.
     * @param string $consumerKey - Your consumer key, can be found at http://my.isset.net/
     * @param string $privateKey - Your private key, can be found at http://my.isset.net/
     */
    public function __construct($consumerKey, $privateKey)
    {
        $this->consumerKey = $consumerKey;
        $this->privateKey = $privateKey;
    }

    /**
     * Inject services so we can handle the connection to login
     * @param ConnectionInterface $connection
     * @param TokenVault $tokenVault
     * @param PayloadFactory $payloadFactory
     */
    public function injectServices(ConnectionInterface $connection, TokenVault $tokenVault, PayloadFactory $payloadFactory)
    {
        $this->connection = $connection;
        $this->tokenVault = $tokenVault;
        $this->payloadFactory = $payloadFactory;
    }

    /**
     * @return Token
     * @throws ResponseException
     * @throws TokenNotFoundException
     * @throws UnableToCreateHashException
     */
    public function getToken()
    {
        if ($this->tokenVault->hasToken($this->consumerKey)) {

            return $this->tokenVault->getToken($this->consumerKey);
        }
        $tokenCreator = new TokenCreator($this->connection, $this->payloadFactory);
        $token = $tokenCreator->requestTokenFromMyIsset($this->consumerKey, $this->privateKey);
        $this->tokenVault->addToken($this->consumerKey, $token);

        return $token;
    }


}