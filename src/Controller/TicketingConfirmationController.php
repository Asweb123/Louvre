<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TicketingConfirmationController extends Controller
{
    /**
     * @Route("/billetterie/confirmation", name="ticketing_confirmation")
     */
    public function index()
    {
        return $this->render('ticketing_confirmation/index.html.twig');
    }
}
