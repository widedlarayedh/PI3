<?php

namespace ShopBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PanierControllerTest extends WebTestCase
{
    public function testRead()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/read');
    }

}
