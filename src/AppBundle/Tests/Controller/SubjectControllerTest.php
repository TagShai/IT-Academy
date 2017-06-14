<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SubjectControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/subjects');
    }

    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/subjects/create');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/subjects/{id}/edit');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/subjects/delete/{id}');
    }

}
