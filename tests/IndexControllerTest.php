<?php
/**
 * Created by PhpStorm.
 * User: SIMON
 * Date: 09/07/2018
 * Time: 12:21
 */

namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class IndexControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $link = $crawler
            ->filter('a > button')
            ->parents()
            ->link()
        ;

        $client->click($link);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}
