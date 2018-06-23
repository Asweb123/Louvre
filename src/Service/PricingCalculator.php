<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class PricingCalculator
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function setTicketsAndOrderPricing($order)
    {
        $ticketsList = $order->getTicketsList();
        $totalPrice = 0.00;

        $date60YearsAgo = (new \DateTime("now", new \DateTimeZone("Europe/Paris")))->sub(new \DateInterval('P60Y'));
        $date4YearsAgo = (new \DateTime("now", new \DateTimeZone("Europe/Paris")))->sub(new \DateInterval('P4Y'));
        $date12YearsAgo = (new \DateTime("now", new \DateTimeZone("Europe/Paris")))->sub(new \DateInterval('P12Y'));


        foreach ($ticketsList as $ticket) {
            $reduction = $ticket->getReduction();
            $dateOfBirth = $ticket->getDateOfBirth();

            if($reduction === true)
            {
                $ticket->setPricing('Tarif Réduit');
                $ticket->setPrice($this->params->get('reduced_price'));

                $totalPrice += $ticket->getPrice();
            }

            elseif (($dateOfBirth > $date60YearsAgo) && ($dateOfBirth <= $date12YearsAgo))
            {
                $ticket->setPricing('Tarif Normal');
                $ticket->setPrice($this->params->get('base_price'));

                $totalPrice += $ticket->getPrice();
            }

            elseif ($dateOfBirth <= $date60YearsAgo)
            {
                $ticket->setPricing('Tarif Senior');
                $ticket->setPrice($this->params->get('senior_price'));

                $totalPrice += $ticket->getPrice();
            }

            elseif (($dateOfBirth > $date12YearsAgo) && ($dateOfBirth <= $date4YearsAgo))
            {
                $ticket->setPricing('Tarif Enfant');
                $ticket->setPrice($this->params->get('children_price'));

                $totalPrice += $ticket->getPrice();
            }

            elseif ($dateOfBirth > $date4YearsAgo)
            {
                $ticket->setPricing('Tarif Tout-petit');
                $ticket->setPrice($this->params->get('baby_price'));

                $totalPrice += $ticket->getPrice();
            }

        }

        if ($order->getTicketType() == 2)
        {
            $order->setTotalPrice($totalPrice / 2);
        }
        else
        {
            $order->setTotalPrice($totalPrice);
        }

        return $order;
    }

}