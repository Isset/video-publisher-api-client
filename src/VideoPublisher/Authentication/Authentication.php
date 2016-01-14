<?php

namespace VideoPublisher\Authentication;

use VideoPublisher\Payload\PayloadFactory;
use VideoPublisher\Security\Token;
use VideoPublisher\Security\TokenVault;
use VideoPublisher\Connection\ConnectionInterface;

/**
 * Class Authentication.
 *
 * @author Bart Malestein <bart@isset.nl>
 */
interface Authentication
{
    /**
     * @return Token
     */
    public function getToken();

    /**
     * @param ConnectionInterface $connection
     * @param TokenVault $tokenVault
     * @param PayloadFactory $payloadFactory
     */
    public function injectServices(ConnectionInterface $connection, TokenVault $tokenVault, PayloadFactory $payloadFactory);

}