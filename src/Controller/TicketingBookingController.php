<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Ticket;
use App\Form\OrderType;
use App\Service\TotalTicketsDayCalculator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TicketingBookingController extends AbstractController
{
    /**
     * @Route("/billetterie/reservation", name="ticketing_booking")
     */
    public function booking(SessionInterface $session, Request $request, TotalTicketsDayCalculator $totalTicketsDayCalculator)
    {

        if(($session->has('order')) === true) {
            $order = $session->get('order');
        }
        else {
            $order = new Order();
        }


        $form = $this->createForm(OrderType::class, $order);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $order = $form->getData();

            $ticketsQuantity = $order->getTicketsQuantity();

            for ($i = 1; $i <= $ticketsQuantity; $i++) {
                $ticket= new Ticket();
                $order->addTicketsList($ticket);
            }


            $session->set('order', $order);

            return $this->redirectToRoute('ticketing_beneficiary');
        }

        return $this->render('ticketing/booking.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
