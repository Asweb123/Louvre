<?php

namespace App\Controller;

use App\Entity\Order;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TicketingBookingController extends Controller
{
    /**
     * @Route("/billetterie/reservation", name="ticketing_booking")
     */
    public function booking(Request $request)
    {
        $order = new Order();

        $form = $this->createFormBuilder($order)
            ->add('bookingDate', DateType::class, array(
                'widget' => 'single_text',
                'label' => 'Date de réservation'
            ))
            ->add('ticketsNumber', NumberType::class, array(
                'label' => 'Nombre de billets'
            ))
            ->add('ticketType', ChoiceType::class, array(
                'label' => 'Type de billet',
                'choices' => array(
                    'Journée' => '1',
                    'Demi-Journée' => '2'
                )
            ))
            ->add('validate', SubmitType::class, array('label' => 'Valider'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $order = $form->getData();

            return $this->redirectToRoute('ticketing_beneficiary');
        }

        return $this->render('ticketing/booking.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
