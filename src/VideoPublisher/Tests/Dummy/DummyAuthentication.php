<?php

namespace VideoPublisher\Tests\Dummy;

use VideoPublisher\Authentication\Authentication;
use VideoPublisher\Connection\ConnectionInterface;
use VideoPublisher\Payload\PayloadFactory;
use VideoPublisher\Security\Token;
use VideoPublisher\Security\TokenVault;

class DummyAuthentication implements Authentication
{

    /**
     * @return Token
     */
    public function getToken()
    {
        return new Token('foo', 'dummy-token');
    }

    /**
     * @param ConnectionInterface $connection
     * @param TokenVault $tokenVault
     * @param PayloadFactory $payloadFactory
     */
    public function injectServices(ConnectionInterface $connection, TokenVault $tokenVault, PayloadFactory $payloadFactory)
    {
        // TODO: Implement injectServices() method.
    }
}