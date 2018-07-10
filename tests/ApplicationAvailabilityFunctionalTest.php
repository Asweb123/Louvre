<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
class ApplicationAvailabilityFunctionalTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function urlProvider()
    {
        yield ['/'];
        yield ['/billetterie/reservation'];
        yield ['/contact'];
    }
}