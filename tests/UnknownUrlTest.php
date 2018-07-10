<?php
/**
 * Created by PhpStorm.
 * User: SIMON
 * Date: 09/07/2018
 * Time: 10:38
 */

namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UnknownUrlTest extends WebTestCase
{
    public function testUnknownUrl()
    {
        $client = static::createClient();

        $client->request('GET', '/unknownurl');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}