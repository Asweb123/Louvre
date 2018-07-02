<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\PricingCalculator;

class TicketingPaymentController extends AbstractController
{
    /**
     * @Route("/billetterie/paiement", name="ticketing_payment")
     */
    public function payment(SessionInterface $session, PricingCalculator $pricingCalculator)
    {
        $order = $session->get('order');

        $order = $pricingCalculator->setTicketsAndOrderPricing($order);

        $session->set('order', $order);

        return $this->render('ticketing/payment.html.twig', array(
            'order' => $order,
            'stripe_public_key' => $this->getParameter('stripe_public_key')
            ));
    }
}
