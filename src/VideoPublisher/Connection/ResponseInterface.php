<?php

namespace VideoPublisher\Connection;

/**
 * Class ResponseInterface.
 *
 * @author Bart Malestein <bart@isset.nl>
 */
interface ResponseInterface
{

    /**
     * @return int
     */
    public function getStatusCode();

    /**
     * @return string
     */
    public function getContent();

    /**
     * @return array
     */
    public function getJsonResponse();

    /**
     * @param $name
     * @return string
     */
    public function getHeaderByName($name);
}