<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InfosController extends Controller
{
    /**
     * @Route("/infos", name="infos")
     */
    public function infos()
    {
        return $this->render('infos/infos.html.twig');
    }
}
