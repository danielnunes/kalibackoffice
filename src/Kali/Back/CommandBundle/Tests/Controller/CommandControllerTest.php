<?php

namespace Kali\Back\CommandBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommandControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/list');
    }

    public function testPlug()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/plug/{id}');
    }

}
