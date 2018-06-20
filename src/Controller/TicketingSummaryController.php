<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TicketingSummaryController extends Controller
{
    /**
     * @Route("/billetterie/resume", name="ticketing_summary")
     */
    public function summary(SessionInterface $session)
    {
        $order = $session->get('order');


        return $this->render('ticketing/summary.html.twig');
    }
}
