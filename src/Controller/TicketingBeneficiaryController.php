<?php

namespace App\Controller;

use App\Entity\Ticket;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TicketingBeneficiaryController extends Controller
{
    /**
     * @Route("/billetterie/beneficiaire", name="ticketing_beneficiary")
     */
    public function beneficiary(Request $request)
    {
        $ticket = new Ticket();

        $form = $this->createFormBuilder($ticket)
            ->add('firstName', TextType::class, array(
                'label' => 'Prénom'
            ))
            ->add('lastName', TextType::class, array(
                'label' => 'Nom'
            ))
            ->add('birthDate', BirthdayType::class, array(
                'label'=> 'Date de naissance'
            ))
            ->add('country', CountryType::class, array(
                'label'=> 'Pays'
            ))
            ->add('validate', SubmitType::class, array('label' => 'Valider'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticket = $form->getData();

            return $this->redirectToRoute('ticketing_summary');
        }

        return $this->render('ticketing/beneficiary.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
