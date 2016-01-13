DESCRIPTION
===========
This is the API client for http://my.videopublisher.io/ API. Use this to simplify the use of the API in PHP.

Example
=======

The API requires an consumer and private key which can be requested at info@my.videopublisher.io.

```
    <?php

    include '../src/IssetBV/VideoPublisherClient/Autoloader.php'

    $client = new VideoPublisherClient($authentication, 'your_local_token_cache_folder');

```
