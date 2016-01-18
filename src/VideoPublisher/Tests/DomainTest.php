<?php

use VideoPublisher\Domain\SimpleStream;
use VideoPublisher\Domain\Stream;

include_once 'src/VideoPublisher/AutoLoader.php';

/**
 * Class DomainTest.
 *
 * @author Bart Malestein <bart@isset.nl>
 */
class DomainTest extends \PHPUnit_Framework_TestCase
{

    public function testSimpleStreamObject()
    {
        $simpleStream = new SimpleStream([
            'streamName' => 'test',
            'uuid' => '00000000-0000-0000-0000-00000000',
            'status' => 'mock',
            'enabled' => true
        ]);

        $this->assertEquals(true, $simpleStream->getEnabled());
        $this->assertEquals('test', $simpleStream->getName());
    }

    public function testStreamObject()
    {
        $stream = new Stream([
            'streamName' => 'test',
            'uuid' => '00000000-0000-0000-0000-00000000',
            'status' => 'mock',
            'enabled' => true,
            'viewable' => true,
            'view' => [
                'playout_url' => 'http://playout.com/video.mp4',
                'video_player' => 'http://playout.com/player/video.mp4'
            ]
        ]);

        $this->assertEquals('mock', $stream->getStatus());
        $this->assertEquals('test', $stream->getName());
        $this->assertEquals('http://playout.com/video.mp4', $stream->getView()->getPlayoutUrl());
        $this->assertEquals('http://playout.com/player/video.mp4', $stream->getView()->getVideoPlayer());
    }
}