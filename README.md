[![Author](http://img.shields.io/badge/author-issetbv-orange.svg?style=flat-square)](https://isset.nl)
[![Build Status](https://img.shields.io/travis/issetbv/video-publisher-api-client/master.svg?style=flat-square)](https://travis-ci.org/issetbv/video-publisher-api-client)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/issetbv/video-publisher-api-client.svg?style=flat-square)](https://scrutinizer-ci.com/g/issetbv/video-publisher-api-client/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/issetbv/video-publisher-api-client.svg?style=flat-square)](https://scrutinizer-ci.com/g/issetbv/video-publisher-api-client)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/issetbv/video-publisher-api-client.svg?style=flat-square)](https://packagist.org/packages/issetbv/video-publisher-api-client)
[![Total Downloads](https://img.shields.io/packagist/dt/issetbv/video-publisher-api-client.svg?style=flat-square)](https://packagist.org/packages/issetbv/video-publisher-api-client)

DESCRIPTION
===========
This is the API client for http://my.videopublisher.io/ API. Use this to simplify the use of the API in PHP.

Example
=======

The API requires a consumer and private key which can be requested at info@my.videopublisher.io.

```php
<?php

include '../src/IssetBV/VideoPublisherClient/Autoloader.php';

use VideoPublisher\VideoPublisherClient;
use VideoPublisher\Authentication\KeyPairAuthentication;

//Create an authentication, only consumer/private keypair authentication is supported at this time
$authentication = new KeyPairAuthentication('your_consumer_key', 'your_private_key');
//Create the client. On the next request a token will be requested. 
//This token will be cache in 'your_local_token_cache_folder'.
//Make sure this cache folder is writeable by the application.
$client = new VideoPublisherClient($authentication, 'your_local_token_cache_folder');

//Request a list of all your published streams. 
//This will return an array of VideoPublisher\Domain\SimpleStream objects
$list = $client->listStreams();

//Request a specific stream by Uuid. Uuids can be fetched from SimpleStream objects 
//or from http://my.videopublisher.io/ webinterface.
//Example: http://my.videopublisher.io/publish/1A1A1A1A-1A1A-1A1A-1A1A-1A1A1A1A
//This will return an VideoPublisher\Domain\Stream object 
$client->getStream('1A1A1A1A-1A1A-1A1A-1A1A-1A1A1A1A');

```
