<?php

namespace VideoPublisher\Connection;

use VideoPublisher\Payload\Payload;

/**
 * Class ConnectionInterface.
 *
 * @author Bart Malestein <bart@isset.nl>
 */
interface ConnectionInterface
{

    /**
     * @param Payload $payload
     * @return ResponseInterface
     */
    public function sendPayload(Payload $payload);
}