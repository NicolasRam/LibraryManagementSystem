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

    public function testDocAction()
    {
        $client = static::createPantherClient();
        $crawler = $client->request( 'GET', '/' );

        sleep(2);

        $link = $crawler->selectLink('How to create your first page in Symfony')->link();
        $client->click($link);

        sleep(2);

        $this->assertEquals('', $crawler->filter('h1')->count());
    }

}