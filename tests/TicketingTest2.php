<?php
/**
 * Created by PhpStorm.
 * User: SIMON
 * Date: 09/07/2018
 * Time: 11:47
 */

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;



class TicketingTest2 extends WebTestCase
{

    public function testBooking()
    {

        $client = static::createClient();

        $crawler = $client->request('GET', '/billetterie/reservation');

        $formBooking = $crawler->selectButton('Valider')->form(array(
            'order[bookingDate]' => '2019-02-01',
            'order[ticketsQuantity]' => '16',
            'order[ticketType]' => '1',
            'order[emailCustomer][first]' => 'test@live.fr',
            'order[emailCustomer][second]' => 'test@live.fr'
        ));

        $client->submit($formBooking);
        //Because more than 15 tickets block the redirection 302 to ticketing step 2
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }
}
