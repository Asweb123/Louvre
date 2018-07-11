<?php

namespace App\Form;

use App\Entity\OrderCustomer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;



class OrderType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bookingDate', DateType::class, array(
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd-MM-yyyy',
                'label' => 'Date de visite',
                'placeholder' => 'jj/mm/aaaa',
                'attr' => ['class' => 'flatpickr', 'autocomplete' => 'off'],
                'help' => 'Réservation impossible le dimanche. Fermé le mardi, le 1er Mai, le 1er Novembre et le 25 Décembre.'

            ))
            ->add('ticketsQuantity', IntegerType::class, array(
                'label' => 'Nombre de visiteurs',
                'attr' => ['min' => '1']
            ))
            ->add('ticketType', ChoiceType::class, array(
                'label' => 'Type de billet',
                'choices' => array(
                    'Journée' => '1',
                    'Demi-Journée' => '2'
                )
            ))
            ->add('emailCustomer', RepeatedType::class, array(
                'type' => EmailType::class,
                'invalid_message' => 'Les adresses mails ne sont pas identiques.',
                'required' => true,
                'first_options'  => array('label' => 'Adresse mail de réception des billets'),
                'second_options' => array('label' => 'Confirmer l\'adresse mail'),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => OrderCustomer::class,
            'validation_groups' => array('booking')
        ));
    }
}