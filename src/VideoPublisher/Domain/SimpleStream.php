<?php

namespace VideoPublisher\Domain;

/**
 * Class SimpleStream.
 *
 * @author Bart Malestein <bart@isset.nl>
 */
class SimpleStream
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $uuid;

    /**
     * @var string
     */
    private $status;

    /**
     * @var boolean
     */
    private $enabled;

    /**
     * SimpleStream constructor.
     * @param string $data
     */
    public function __construct($data)
    {
        $this->name = $data['streamName'];
        $this->uuid = $data['uuid'];
        $this->status = $data['status'];
        $this->enabled = (boolean)$data['enabled'];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

}