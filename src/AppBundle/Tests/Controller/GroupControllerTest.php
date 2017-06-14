<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GroupControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/groups');
    }

    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/groups/create');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/groups/edit/{id}');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/groups/delete/{id}');
    }

}
