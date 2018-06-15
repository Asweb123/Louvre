<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TicketingPaymentController extends Controller
{
    /**
     * @Route("/billetterie/paiement", name="ticketing_payment")
     */
    public function index()
    {
        return $this->render('ticketing_payment/index.html.twig');
    }
}
