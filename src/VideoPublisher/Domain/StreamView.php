<?php

namespace VideoPublisher\Domain;

/**
 * Class StreamView.
 *
 * @author Bart Malestein <bart@isset.nl>
 */
class StreamView
{
    /**
     * @var string
     */
    private $playoutUrl;

    /**
     * @var string
     */
    private $videoPlayer;

    /**
     * StreamView constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->playoutUrl = $data['playout_url'];
        $this->videoPlayer = $data['video_player'];
    }

    /**
     * @return string
     */
    public function getPlayoutUrl()
    {
        return $this->playoutUrl;
    }

    /**
     * @return string
     */
    public function getVideoPlayer()
    {
        return $this->videoPlayer;
    }

}