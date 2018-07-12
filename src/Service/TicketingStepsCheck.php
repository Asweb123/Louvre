<?php

namespace App\Service;


class TicketingStepsCheck
{

    public function beneficiaryStepCheck($order)
    {
        if(($order->getBookingDate() === null)
            || ($order->getTicketsQuantity() === null)
            || ($order->getTicketType() === null)
            || ($order->getEmailCustomer() === null)) {

            return false;
        }
    }


    public function paymentStepCheck($order)
    {
        $ticketsCheck = null;

        if($order->getTicketsList() === null){
             $ticketsCheck = false;

        } elseif($order->getTicketsList() !== null) {

            foreach ($order->getTicketsList() as $ticket){

                if (($ticket->getFirstName() === null)
                    || ($ticket->getLastName() === null)
                    || ($ticket->getCountry() === null)
                    || ($ticket->getDateOfBirth() === null)
                    || ($ticket->getreduction() === null)) {

                      $ticketsCheck = false;
                }
            }
        }

        return $ticketsCheck;
    }
}
