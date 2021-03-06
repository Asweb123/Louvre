<?php

namespace App\Controller;

use App\Entity\OrderCustomer;

use App\Form\Type\OrderType;
use App\Service\BeneficiariesListCreator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TicketingBookingController extends AbstractController
{
    /**
     * @Route({
     *     "fr": "/billetterie/reservation",
     *     "en": "/ticketing/booking"
     * }, name="ticketing_booking")
     */
    public function booking(Session $session, Request $request, BeneficiariesListCreator $beneficiariesListCreator)
    {

        if($session->has('order') === true) {
            $order = $session->get('order');
            $originalTicketsQuantity = $order->getTicketsQuantity();

        } else {
            $order = new OrderCustomer();
            $originalTicketsQuantity = 0;
        }


        $form = $this->createForm(OrderType::class, $order);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $order = $form->getData();

            $newTicketsQuantity = $order->getTicketsQuantity();
            $order = $beneficiariesListCreator->beneficiariesListCreator($order, $originalTicketsQuantity,$newTicketsQuantity);

            $session->set('order', $order);

            return $this->redirectToRoute('ticketing_beneficiary');
        }


        return $this->render('ticketing/booking.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
