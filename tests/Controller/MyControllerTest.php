<?php

namespace App\Tests\Controller;




use Symfony\Component\Panther\PantherTestCase;

class MyControllerTest extends PantherTestCase
{
    public function testMyAction()
    {
        $client = static::createClient();
        $client->request( 'GET', '/' );
        $crawler = $client->getCrawler();
        dump($crawler->filter('h1')->count());

        $this->assertContains(
            'Symfony',
            $client->getResponse()->getContent()
        );
        $this->assertEquals(1, $crawler->filter('h1')->count());
    }
}