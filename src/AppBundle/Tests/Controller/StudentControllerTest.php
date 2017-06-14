<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StudentControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/students');
    }

    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/students/create');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/students/edit/{id}');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/students/delete/{id}');
    }

}
