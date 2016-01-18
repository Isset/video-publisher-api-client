<?php

namespace VideoPublisher\Tests\Dummy;

use VideoPublisher\Connection\ConnectionInterface;
use VideoPublisher\Connection\Curl\CurlResponse;
use VideoPublisher\Connection\ResponseInterface;
use VideoPublisher\Payload\Payload;

class DummyConnection implements ConnectionInterface
{

    /**
     * @param Payload $payload
     * @return ResponseInterface
     */
    public function sendPayload(Payload $payload)
    {
        switch ($payload->getUrl()) {
            case 'http://my.videopublisher.io/api/published':
                return $this->generateListStreamsResponse();
            case 'http://my.videopublisher.io/api/publish/00000000-0000-0000-0000-00000000':
                return $this->generateGetStreamResponse();
            case 'http://my.videopublisher.io/exception/api/published':
                return new CurlResponse(400, null, null);
            case 'http://my.videopublisher.io/exception/api/publish/00000000-0000-0000-0000-00000000':
                return new CurlResponse(400, null, null);
        }
    }

    /**
     * @return CurlResponse
     */
    private function generateListStreamsResponse()
    {
        $streams = [];
        $streams[] = [
            'streamName' => 'test',
            'uuid' => '00000000-0000-0000-0000-00000000',
            'status' => 'mock',
            'enabled' => true
        ];
        $streams[] = [
            'streamName' => 'test',
            'uuid' => '00000000-0000-0000-0000-00000000',
            'status' => 'mock',
            'enabled' => true
        ];
        $streams[] = [
            'streamName' => 'test',
            'uuid' => '00000000-0000-0000-0000-00000000',
            'status' => 'mock',
            'enabled' => true
        ];

        return new CurlResponse(200, null, json_encode($streams));
    }

    /**
     * @return CurlResponse
     */
    private function generateGetStreamResponse()
    {
        $stream = [
            'streamName' => 'test',
            'uuid' => '00000000-0000-0000-0000-00000000',
            'status' => 'mock',
            'enabled' => true,
            'viewable' => true,
            'view' => [
                'playout_url' => 'http://playout.com/video.mp4',
                'video_player' => 'http://playout.com/player/video.mp4'
            ]
        ];
        return new CurlResponse(200, null, json_encode($stream));
    }
}