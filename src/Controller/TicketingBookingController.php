<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Ticket;
use App\Form\OrderType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TicketingBookingController extends AbstractController
{
    /**
     * @Route("/billetterie/reservation", name="ticketing_booking")
     */
    public function booking(SessionInterface $session, Request $request)
    {
        $order = new Order();

        $form = $this->createForm(OrderType::class, $order);

        $form->add('validate', SubmitType::class, array('label' => 'Valider'));


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
