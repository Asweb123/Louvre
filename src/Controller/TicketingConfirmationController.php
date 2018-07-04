<?php

namespace App\Controller;

use App\Service\CodeGenerator;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class TicketingConfirmationController extends Controller
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }


    /**
     * @Route("/billetterie/confirmation", name="ticketing_confirmation")
     */
    public function confirmation(SessionInterface $session, CodeGenerator $codeGenerator, \Swift_Mailer $mailer)
    {
        $order = $session->get('order');

        if (($order->getBookingRef()) === null) {
            // Set your secret key: remember to change this to your live secret key in production
            // See your keys here: https://dashboard.stripe.com/account/apikeys
     /*       \Stripe\Stripe::setApiKey($this->params->get('stripe_secret_key'));

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
        }


        $html = $this->renderView('pdf.html.twig',  array(
            'order' => $order,
        ));


        $dompdf = $this->get('dompdf');


     //  $dompdf->streamHtml($html, "document.pdf");

        $pdf = $dompdf->getPdf($html);

        $attachment = new \Swift_Attachment($pdf, 'louvre-reservation.pdf', 'application/pdf');
        $message = (new \Swift_Message('Le Louvre'))
            ->setFrom('billetterielouvreservice@gmail.com')
            ->setTo($order->getEmailCustomer())
            ->attach($attachment)
            ->setBody(
                $this->renderView('mail.html.twig', array('order' => $order)
                ),
                'text/html'
            )
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;

        $mailer->send($message);







        $session->set('order', $order);

        return $this->render('ticketing/confirmation.html.twig',  array(
            'order' => $order,
        ));
    }

}
