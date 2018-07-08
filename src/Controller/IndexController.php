<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class IndexController extends AbstractController
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    /**
     * @Route("/", name="index")
     */
    public function index(SessionInterface $session)
    {
        $session->clear();

        return $this->render('index/index.html.twig', array(
            'babyPrice' => $this->params->get('baby_price'),
            'childrenPrice' => $this->params->get('children_price'),
            'basePrice' => $this->params->get('base_price'),
            'seniorPrice' => $this->params->get('senior_price'),
            'reducedPrice' => $this->params->get('reduced_price')
        ));
    }
}
