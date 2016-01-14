<?php
namespace VideoPublisher\Payload;

/**
 * Class Payload.
 *
 * @author Bart Malestein <bart@isset.nl>
 */
class Payload
{

    /**
     * @var array
     */
    protected $data = array();

    /**
     * @var array
     */
    protected $headers = array();

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $method;

    /**
     * Payload constructor.
     * @param string $url
     * @param string $method
     */
    public function __construct($url, $method = 'post')
    {
        $this->url = $url;
        $this->method = $method;
    }

    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $header
     * @param $value
     * @return $this
     */
    public function setHeader($header, $value)
    {
        $this->headers[$header] = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $data
     */
    public function overwritePostData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function setPostData($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getPostData()
    {
        return $this->data;
    }

    /**
     * @param $method
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }
}
