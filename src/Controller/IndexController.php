<?php

namespace App\Controller;

use App\Entity\Ticket;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $ticket= new Ticket();

        return $this->render('index/index.html.twig', array(
            'ticket' => $ticket
        ));
    }
}
