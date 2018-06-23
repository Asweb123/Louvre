<?php


namespace App\Service;



class PricingSetter
{
    public function getPricing($order)
    {
        $ticketsList = $order->getTicketsList();

        $date60YearsAgo = (new \DateTime("now", new \DateTimeZone("Europe/Paris")))->sub(new \DateInterval('P60Y'));
        $date4YearsAgo = (new \DateTime("now", new \DateTimeZone("Europe/Paris")))->sub(new \DateInterval('P4Y'));
        $date12YearsAgo = (new \DateTime("now", new \DateTimeZone("Europe/Paris")))->sub(new \DateInterval('P12Y'));


        foreach ($ticketsList as $ticket) {
            $reduction = $ticket->getReduction();
            $dateOfBirth =$ticket->getDateOfBirth();

            if($reduction === true)
            {
                $ticket->setPricing("reduction");
            }
            elseif ($dateOfBirth <= $date60YearsAgo)
            {
                $ticket->setPricing("senior");
            }
            elseif ($dateOfBirth > $date4YearsAgo)
            {
                $ticket->setPricing("baby");
            }
            elseif (($dateOfBirth > $date60YearsAgo)
                && ($dateOfBirth <= $date12YearsAgo))
            {

                $ticket->setPricing("normal");
            }
            elseif (($dateOfBirth > $date12YearsAgo)
                && ($dateOfBirth <= $date4YearsAgo))
            {
                $ticket->setPricing("children");
            }
        }

        return $order;
    }
}