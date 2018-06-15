<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TicketingSummaryController extends Controller
{
    /**
     * @Route("/billetterie/resume", name="ticketing_summary")
     */
    public function index()
    {
        return $this->render('ticketing_summary/index.html.twig');
    }
}
