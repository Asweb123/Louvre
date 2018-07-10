<?php

namespace App\Service;


use App\Entity\Ticket;


class BeneficiariesListCreator
{
    public function beneficiariesListCreator($order, $originalTicketsQuantity, $newTicketsQuantity)
    {
        $differenceTicketsQuantity = $originalTicketsQuantity - $newTicketsQuantity;

        if($differenceTicketsQuantity < 0) {
            for ($i = 1; $i <= abs($differenceTicketsQuantity); $i++) {
                $ticket= new Ticket();
                $order->addTicketsList($ticket);
            }
        } else if($differenceTicketsQuantity > 0) {
            for ($i = 1; $i <= $differenceTicketsQuantity; $i++) {
                $ticketsList = $order->getTicketsList();
                $ticketsArray = reset($ticketsList);
                $lastTicket = end($ticketsArray);
                $order->removeTicketsList($lastTicket);
            }
        }

        return $order;
    }
}