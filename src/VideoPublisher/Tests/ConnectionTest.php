<?php

use VideoPublisher\Domain\SimpleStream;
use VideoPublisher\Domain\Stream;
use VideoPublisher\Tests\Dummy\DummyAuthentication;
use VideoPublisher\Tests\Dummy\DummyConnection;
use VideoPublisher\VideoPublisherClient;

include_once 'src/VideoPublisher/AutoLoader.php';

/**
 * Class ConnectionTest.
 *
 * @author Bart Malestein <bart@isset.nl>
 */
class ConnectionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * List stream test
     */
    public function testListStreams()
    {
        $client = new VideoPublisherClient(new DummyAuthentication(), 'src', 'http://my.videopublisher.io/', new DummyConnection());
        $simpleStreams = $client->listStreams();

        $this->assertEquals(3, count($simpleStreams));
        $this->assertContainsOnlyInstancesOf(SimpleStream::class, $simpleStreams);
    }

    /**
     * @expectedException \VideoPublisher\Exception\BadResponseException
     */
    public function testListStreamsException()
    {
        $client = new VideoPublisherClient(new DummyAuthentication(), 'src', 'http://my.videopublisher.io/exception', new DummyConnection());
        $client->listStreams();
    }

    /**
     * Get stream test
     */
    public function testGetStream()
    {
        $client = new VideoPublisherClient(new DummyAuthentication(), 'src', 'http://my.videopublisher.io/', new DummyConnection());
        $stream = $client->getStream('00000000-0000-0000-0000-00000000');

        $this->assertEquals('00000000-0000-0000-0000-00000000', $stream->getUuid());
        $this->assertEquals('mock', $stream->getStatus());
        $this->assertEquals('http://playout.com/video.mp4', $stream->getView()->getPlayoutUrl());
        $this->assertEquals('http://playout.com/player/video.mp4', $stream->getView()->getVideoPlayer());
        $this->assertInstanceOf(Stream::class, $stream);
    }

    /**
     * @expectedException \VideoPublisher\Exception\StreamNotFoundException
     */
    public function testGetStreamException()
    {
        $client = new VideoPublisherClient(new DummyAuthentication(), 'src', 'http://my.videopublisher.io/exception', new DummyConnection());
        $client->getStream('00000000-0000-0000-0000-00000000');
    }

}