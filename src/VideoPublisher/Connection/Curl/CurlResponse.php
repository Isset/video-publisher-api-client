<?php
namespace VideoPublisher\Connection\Curl;

use VideoPublisher\Connection\ResponseInterface;
use VideoPublisher\Exception\KeyNotFoundException;

/**
 * Class CurlResponse.
 *
 * @author Bart Malestein <bart@isset.nl>
 */
class CurlResponse implements ResponseInterface
{

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $headers;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * CurlResponse constructor.
     * @param $statusCode
     * @param $headers
     * @param $content
     */
    public function __construct($statusCode, $headers, $content)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return array
     */
    public function getJsonResponse()
    {
        return json_decode($this->content, true);
    }

    /**
     * @param $name
     * @return bool|string
     * @throws KeyNotFoundException
     */
    public function getHeaderByName($name)
    {
        $headers = explode("\n", $this->headers);
        
        foreach ($headers as $header) {
            
            if (empty($header)) {
                
                continue;
            }
            $keyVal = explode(": ", $header);
            if ($keyVal[0] === $name) {
                
                return trim($keyVal[1], " \t\n\r\0\x0B");
            }
        }
        
        throw new KeyNotFoundException($name);
    }
}
