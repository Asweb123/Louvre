<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class TicketingPaymentController extends AbstractController
{
    /**
     * @Route("/billetterie/paiement", name="ticketing_payment")
     */
    public function index(SessionInterface $session)
    {
        $order = $session->get('order');

        return $this->render('ticketing/payment.html.twig');
    }
}
