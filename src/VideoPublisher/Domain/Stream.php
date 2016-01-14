<?php

namespace VideoPublisher\Domain;

/**
 * Class Stream.
 *
 * @author Bart Malestein <bart@isset.nl>
 */
class Stream
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
     * @var bool
     */
    private $enabled;

    /**
     * @var bool
     */
    private $viewable;

    /**
     * @var StreamView
     */
    private $view;

    /**
     * Stream constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->name = $data['streamName'];
        $this->uuid = $data['uuid'];
        $this->status = $data['status'];
        $this->enabled = $data['enabled'];
        $this->viewable = $data['viewable'];
        $this->view = new StreamView($data['view']);
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
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return boolean
     */
    public function isViewable()
    {
        return $this->viewable;
    }

    /**
     * @return StreamView
     */
    public function getView()
    {
        return $this->view;
    }
}