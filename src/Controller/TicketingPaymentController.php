<?php

namespace App\Controller;

use App\Service\TicketingStepsCheck;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\PricingCalculator;

class TicketingPaymentController extends AbstractController
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    /**
     * @Route({
     *     "fr": "/billetterie/paiement",
     *     "en": "/ticketing/payment"
     * }, name="ticketing_payment")
     */
    public function payment(Session $session, PricingCalculator $pricingCalculator, TicketingStepsCheck $ticketingStepsCheck)
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
