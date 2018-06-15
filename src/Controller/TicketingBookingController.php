<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TicketingBookingController extends Controller
{
    /**
     * @Route("/billetterie/reservation", name="ticketing_booking")
     */
    public function index()
    {
        return $this->render('ticketing_booking/index.html.twig');
    }
}
