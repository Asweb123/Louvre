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
        $totalPrice = 0;

        if (($order->getTicketType()) == 2)
        {
            $priceType = 2;
        }
        else
        {
            $priceType = 1;
        }

        $date60YearsAgo = (new \DateTime("now", new \DateTimeZone("Europe/Paris")))->sub(new \DateInterval('P60Y'));
        $date4YearsAgo = (new \DateTime("now", new \DateTimeZone("Europe/Paris")))->sub(new \DateInterval('P4Y'));
        $date12YearsAgo = (new \DateTime("now", new \DateTimeZone("Europe/Paris")))->sub(new \DateInterval('P12Y'));


        foreach ($ticketsList as $ticket) {
            $reduction = $ticket->getReduction();
            $dateOfBirth = $ticket->getDateOfBirth();

            if($reduction === true)
            {
                $ticket->setPricing(5);
                $ticket->setPrice(($this->params->get('reduced_price')) / $priceType);

                $totalPrice += $ticket->getPrice();
            }

            elseif (($dateOfBirth > $date60YearsAgo) && ($dateOfBirth <= $date12YearsAgo))
            {
                $ticket->setPricing(3);
                $ticket->setPrice(($this->params->get('base_price')) / $priceType);

                $totalPrice += $ticket->getPrice();
            }

            elseif ($dateOfBirth <= $date60YearsAgo)
            {
                $ticket->setPricing(4);
                $ticket->setPrice(($this->params->get('senior_price')) / $priceType);

                $totalPrice += $ticket->getPrice();
            }

            elseif (($dateOfBirth > $date12YearsAgo) && ($dateOfBirth <= $date4YearsAgo))
            {
                $ticket->setPricing(2);
                $ticket->setPrice(($this->params->get('children_price')) / $priceType);

                $totalPrice += $ticket->getPrice();
            }

            elseif ($dateOfBirth > $date4YearsAgo)
            {
                $ticket->setPricing(1);
                $ticket->setPrice(($this->params->get('baby_price')) / $priceType);

                $totalPrice += $ticket->getPrice();
            }
        }
        $order->setTotalPrice($totalPrice);

        return $order;
    }
}
