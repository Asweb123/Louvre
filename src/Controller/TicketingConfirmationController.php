<?php

namespace App\Controller;

use App\Service\CodeGenerator;
use App\Service\TicketingStepsCheck;
use Doctrine\ORM\EntityManagerInterface;
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
    public function confirmation(SessionInterface $session, CodeGenerator $codeGenerator,
                                 EntityManagerInterface $entityManager, \Swift_Mailer $mailer,
                                 TicketingStepsCheck $ticketingStepsCheck)
    {
        if($session->has('order') === true) {
            $order = $session->get('order');

            if(($ticketingStepsCheck->beneficiaryStepCheck($order) === false)
                || ($ticketingStepsCheck->paymentStepCheck($order) === false)
                || ($order->getTotalPrice() === null)) {

                return $this->redirectToRoute('ticketing_booking');
            }
        } else {
            return $this->redirectToRoute('ticketing_booking');
        }


        if ($order->getBookingRef() === null) {

            \Stripe\Stripe::setApiKey($this->params->get('stripe_secret_key'));

            $token = $_POST['stripeToken'];
            $charge = \Stripe\Charge::create([
                'amount' => (($order->getTotalPrice())*100),
                'currency' => 'eur',
                'description' => 'Louvre Billetterie',
                'source' => $token,
            ]);

            if((isset($charge) === true) && ($charge !== null)) {

                $bookingRef = $codeGenerator->codeGenerator();
                $order->setBookingRef($bookingRef);

                $entityManager->persist($order);
                $entityManager->flush();


                $html = $this->renderView('pdf.html.twig',  array('order' => $order));
                $dompdf = $this->get('dompdf');
                //  $dompdf->streamHtml($html, "document.pdf");
                $pdf = $dompdf->getPdf($html);


                $attachment = new \Swift_Attachment($pdf, 'louvre-reservation.pdf', 'application/pdf');
                $message = (new \Swift_Message('Le Louvre'))
                    ->setFrom('billetterielouvreservice@gmail.com')
                    ->setTo($order->getEmailCustomer())
                    ->attach($attachment)
                    ->setBody($this->renderView('mail.html.twig', array('order' => $order)), 'text/html');
                $mailer->send($message);

            } else {


                return $this->redirectToRoute('ticketing_payment');
            }
        }

        $session->set('order', $order);

        return $this->render('ticketing/confirmation.html.twig',  array('order' => $order));
    }

}
