<?php

namespace Functionality\ContentBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StreamControllerTest extends WebTestCase
{
    public function testCreatestream()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/createStream');
    }

}
