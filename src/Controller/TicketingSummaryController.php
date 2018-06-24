<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\PricingCalculator;

class TicketingSummaryController extends AbstractController
{
    /**
     * @Route("/billetterie/resume", name="ticketing_summary")
     */
    public function summary(SessionInterface $session, PricingCalculator $pricingCalculator)
    {
        $order = $session->get('order');

        $order = $pricingCalculator->setTicketsAndOrderPricing($order);

        $order = $session->set('order');

        return $this->render('ticketing/summary.html.twig', array(
            'order' => $order));
    }
}
