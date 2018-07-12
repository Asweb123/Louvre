<?php
/**
 * Created by PhpStorm.
 * User: SIMON
 * Date: 09/07/2018
 * Time: 11:47
 */

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;



class TicketingTest1 extends WebTestCase
{

    public function testBooking()
    {

        $client = static::createClient();

        $crawler = $client->request('GET', '/billetterie/reservation');

        $formBooking = $crawler->selectButton('Valider')->form(array(
            'order[bookingDate]' => '2019-02-01',
            'order[ticketsQuantity]' => '5',
            'order[ticketType]' => '1',
            'order[emailCustomer][first]' => 'test@live.fr',
            'order[emailCustomer][second]' => 'test@live.fr'
        ));

        $client->submit($formBooking);

        $crawler = $client->followRedirect();

        //Control 5 Beneficiaries form for ticketsQuantity = 5
        $this->assertContains('Personne 5', $client->getResponse()->getContent());

        $formBeneficiaries = $crawler->selectButton('Valider')->form();

        $formBeneficiaries['beneficiaries_list[ticketsList][0][firstName]'] = 'Arthur';
        $formBeneficiaries['beneficiaries_list[ticketsList][0][lastName]'] = 'Simon';
        $formBeneficiaries['beneficiaries_list[ticketsList][0][dateOfBirth][year]']->select(1930);
        $formBeneficiaries['beneficiaries_list[ticketsList][0][dateOfBirth][month]']->select(01);
        $formBeneficiaries['beneficiaries_list[ticketsList][0][dateOfBirth][day]']->select(22);
        $formBeneficiaries['beneficiaries_list[ticketsList][0][country]']->select('FR');
        $formBeneficiaries['beneficiaries_list[ticketsList][0][reduction]']->untick();

        $formBeneficiaries['beneficiaries_list[ticketsList][1][firstName]'] = 'Pierre';
        $formBeneficiaries['beneficiaries_list[ticketsList][1][lastName]'] = 'Simon';
        $formBeneficiaries['beneficiaries_list[ticketsList][1][dateOfBirth][year]']->select(1985);
        $formBeneficiaries['beneficiaries_list[ticketsList][1][dateOfBirth][month]']->select(02);
        $formBeneficiaries['beneficiaries_list[ticketsList][1][dateOfBirth][day]']->select(01);
        $formBeneficiaries['beneficiaries_list[ticketsList][1][country]']->select('AF');
        $formBeneficiaries['beneficiaries_list[ticketsList][1][reduction]']->untick();

        $formBeneficiaries['beneficiaries_list[ticketsList][2][firstName]'] = 'Léa';
        $formBeneficiaries['beneficiaries_list[ticketsList][2][lastName]'] = 'Simon';
        $formBeneficiaries['beneficiaries_list[ticketsList][2][dateOfBirth][year]']->select(1985);
        $formBeneficiaries['beneficiaries_list[ticketsList][2][dateOfBirth][month]']->select(03);
        $formBeneficiaries['beneficiaries_list[ticketsList][2][dateOfBirth][day]']->select(11);
        $formBeneficiaries['beneficiaries_list[ticketsList][2][country]']->select('AF');
        $formBeneficiaries['beneficiaries_list[ticketsList][2][reduction]']->tick();

        $formBeneficiaries['beneficiaries_list[ticketsList][3][firstName]'] = 'Marc';
        $formBeneficiaries['beneficiaries_list[ticketsList][3][lastName]'] = 'Simon';
        $formBeneficiaries['beneficiaries_list[ticketsList][3][dateOfBirth][year]']->select(2018);
        $formBeneficiaries['beneficiaries_list[ticketsList][3][dateOfBirth][month]']->select(02);
        $formBeneficiaries['beneficiaries_list[ticketsList][3][dateOfBirth][day]']->select(01);
        $formBeneficiaries['beneficiaries_list[ticketsList][3][country]']->select('AF');
        $formBeneficiaries['beneficiaries_list[ticketsList][3][reduction]']->untick();

        $formBeneficiaries['beneficiaries_list[ticketsList][4][firstName]'] = 'Mona';
        $formBeneficiaries['beneficiaries_list[ticketsList][4][lastName]'] = 'Simon';
        $formBeneficiaries['beneficiaries_list[ticketsList][4][dateOfBirth][year]']->select(2014);
        $formBeneficiaries['beneficiaries_list[ticketsList][4][dateOfBirth][month]']->select(02);
        $formBeneficiaries['beneficiaries_list[ticketsList][4][dateOfBirth][day]']->select(01);
        $formBeneficiaries['beneficiaries_list[ticketsList][4][country]']->select('AF');
        $formBeneficiaries['beneficiaries_list[ticketsList][4][reduction]']->untick();

        $client->submit($formBeneficiaries);
        //Control third step ticketing redirection
        $this->assertTrue($client->getResponse()->isRedirect('/billetterie/paiement'));

        $crawler = $client->followRedirect();
        //Control Pricing Process for ticketType = 1 (Full Day)
        $this->assertCount(1, $crawler->filter('html:contains("46,00 €")'));
    }
}
