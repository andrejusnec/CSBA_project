<?php


namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserTest extends WebTestCase
{
    public function testUserCreation(): void
    {
        $client = static::createClient();
        $client->request('GET', '/home');
        $qq = $client->getResponse();
        dd($qq);
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Laba');
    }
}