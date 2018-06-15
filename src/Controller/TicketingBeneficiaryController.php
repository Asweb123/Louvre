<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TicketingBeneficiaryController extends Controller
{
    /**
     * @Route("/billetterie/beneficiaire", name="ticketing_beneficiary")
     */
    public function index()
    {
        return $this->render('ticketing/beneficiary.html.twig');
    }
}
