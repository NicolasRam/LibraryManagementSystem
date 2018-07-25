<?php

// tests/Controller/PostControllerTest.php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{

//    public function testShowPost()
//    {
//        $client = static::createClient();
//
//        $client->request('GET', '/post/hello-world');
//
//        $this->assertEquals(200, $client->getResponse()->getStatusCode());
//    }

    public function testMyAction()
    {
        $client = static::createClient();

        $client->request('GET', '/');
        $crawler = $client->getCrawler();

        $this->assertContains('Symfony', $client->getResponse()->getContent());
        $this->assertEquals(1, $crawler->filter('h1')->count());
    }


}