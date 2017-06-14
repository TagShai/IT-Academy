<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/events');
    }

    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/events/create');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/events/edit/{id}');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/events/delete/{id}');
    }

}
