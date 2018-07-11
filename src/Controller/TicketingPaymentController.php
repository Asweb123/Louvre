<?php

namespace App\Controller;

use App\Service\TicketingStepsCheck;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\PricingCalculator;

class TicketingPaymentController extends AbstractController
{
    /**
     * @Route("/billetterie/paiement", name="ticketing_payment")
     */
    public function payment(SessionInterface $session, PricingCalculator $pricingCalculator, TicketingStepsCheck $ticketingStepsCheck)
    {
        if($session->has('order') === true) {
            $order = $session->get('order');

            if(($ticketingStepsCheck->beneficiaryStepCheck($order) === false) || ($ticketingStepsCheck->paymentStepCheck($order) === false)) {
                return $this->redirectToRoute('ticketing_booking');
            }
        } else {
            return $this->redirectToRoute('ticketing_booking');
        }

        $order = $pricingCalculator->setTicketsAndOrderPricing($order);

        $session->set('order', $order);

        return $this->render('ticketing/payment.html.twig', array(
            'order' => $order,
            'stripe_public_key' => $this->getParameter('stripe_public_key')
            ));
    }
}
