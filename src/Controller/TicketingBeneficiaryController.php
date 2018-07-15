<?php

namespace App\Controller;


use App\Form\Type\BeneficiariesListType;
use App\Service\TicketingStepsCheck;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TicketingBeneficiaryController extends AbstractController
{
    /**
     * @Route({
     *     "fr": "/billetterie/beneficiaire",
     *     "en": "/ticketing/beneficiary"
     * }, name="ticketing_beneficiary")
     */
    public function beneficiary(SessionInterface $session, Request $request, TicketingStepsCheck $ticketingStepsCheck)
    {
        if(($session->has('order')) === true) {
            $order = $session->get('order');

            if(($ticketingStepsCheck->beneficiaryStepCheck($order) === false)) {

                return $this->redirectToRoute('ticketing_booking');
            }
        } else {

            return $this->redirectToRoute('ticketing_booking');
        }


        $form = $this->createForm(BeneficiariesListType::class, $order);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $order = $form->getData();
            $session->set('order', $order);

            return $this->redirectToRoute('ticketing_payment');
        }

        return $this->render('ticketing/beneficiary.html.twig', array(
            'form' => $form->createView(),
            'order' => $order
        ));
    }
}
