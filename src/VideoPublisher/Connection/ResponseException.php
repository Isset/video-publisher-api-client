<?php
namespace VideoPublisher\Connection;

use Exception;


/**
 * Class ResponseException.
 *
 * @author Bart Malestein <bart@isset.nl>
 */
class ResponseException extends Exception
{

    /**
     * @var string
     */
    protected $response;

    /**
     * ResponseException constructor.
     * @param string $response
     * @param null $message
     * @param null $code
     * @param null $previous
     */
    public function __construct($response, $message = null, $code = null, $previous = null)
    {
        $this->response = $response;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }
}

