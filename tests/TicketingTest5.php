<?php
/**
 * Created by PhpStorm.
 * User: SIMON
 * Date: 09/07/2018
 * Time: 11:47
 */

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;



class TicketingTest5 extends WebTestCase
{

    public function testBooking()
    {

        $client = static::createClient();

        $crawler = $client->request('GET', '/billetterie/reservation');

        $formBooking = $crawler->selectButton('Valider')->form(array(
            'order[bookingDate]' => '2019-02-01',
            'order[ticketsQuantity]' => '5',
            'order[ticketType]' => '2',
            'order[emailCustomer][first]' => 'test@live.fr',
            'order[emailCustomer][second]' => 'test@live.fr'
        ));

        $client->submit($formBooking);

        $crawler = $client->followRedirect();

        //Control 5 Beneficiaries form for ticketsQuantity = 5
        $this->assertContains('Personne 5', $client->getResponse()->getContent());

        $link = $crawler->selectLink('Retour')->link();
        $crawler = $client->click($link);

        $formBookingUpdate = $crawler->selectButton('Valider')->form(array(
            'order[bookingDate]' => '2019-02-01',
            'order[ticketsQuantity]' => '3',
            'order[ticketType]' => '2',
            'order[emailCustomer][first]' => 'test@live.fr',
            'order[emailCustomer][second]' => 'test@live.fr'
        ));

        $client->submit($formBookingUpdate);

        $formBeneficiaries = $crawler->selectButton('Valider')->form();

        $crawler = $client->followRedirect();

        //Control 2 Beneficiaries form for ticketsQuantity update = 2
        $this->assertContains('Personne 2', $client->getResponse()->getContent());


    }
}