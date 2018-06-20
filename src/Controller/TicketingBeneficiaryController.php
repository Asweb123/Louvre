<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\BeneficiariesListType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TicketingBeneficiaryController extends AbstractController
{
    /**
     * @Route("/billetterie/beneficiaire", name="ticketing_beneficiary")
     */
    public function beneficiary(SessionInterface $session, Request $request)
    {
        $order = $session->get('order');


        $form = $this->createForm(BeneficiariesListType::class, $order);

        $form->add('validate', SubmitType::class, array('label' => 'Valider'));


        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $order = $form->getData();
            $session->set('order', $order);

            return $this->redirectToRoute('ticketing_summary');
        }

        return $this->render('ticketing/beneficiary.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
