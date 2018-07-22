<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InfosController extends AbstractController
{
    /**
     * @Route({
     *     "fr": "/infos-pratiques",
     *     "en": "/practical-information"
     * }, name="infos")
     */
    public function infos()
    {
        return $this->render('infos/infos.html.twig');
    }
}
