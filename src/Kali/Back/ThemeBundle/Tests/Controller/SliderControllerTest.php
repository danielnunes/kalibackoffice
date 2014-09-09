<?php

namespace Kali\Back\ThemeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SliderControllerTest extends WebTestCase
{
    public function testPlug()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/plug');
    }

}
