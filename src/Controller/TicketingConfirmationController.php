<?php

namespace App\Controller;



use App\Service\CodeGenerator;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class TicketingConfirmationController extends AbstractController
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }


    /**
     * @Route("/billetterie/confirmation", name="ticketing_confirmation")
     */
    public function index(SessionInterface $session, CodeGenerator $codeGenerator)
    {
        $order = $session->get('order');

/*
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey($this->params->get('stripe_secret_key'));

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
            'amount' => $order->getTotalPrice(),
            'currency' => 'eur',
            'description' => 'Billetterie Le louvre',
            'source' => $token,
        ]);
*/
        $bookingRef = $codeGenerator->codeGenerator();
        $order = $order->setBookingRef($bookingRef);


        $session->set('order', $order);

        return $this->render('ticketing/confirmation.html.twig',  array(
            'order' => $order,
        ));
    }
}
