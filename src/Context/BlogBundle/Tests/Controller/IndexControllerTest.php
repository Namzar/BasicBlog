<?php

namespace Context\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase
{
    public function testArticle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/article');
    }

}
