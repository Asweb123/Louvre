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
use Symfony\Component\Validator\Constraints\GroupSequence;



class OrderType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bookingDate', DateType::class, array(
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'label' => 'Date de visite',
                'placeholder' => 'jj/mm/aaaa',
                'attr' => ['class' => 'flatpickr', 'autocomplete' => 'off'],
                'help' => 'Réservation impossible le dimanche. Fermé le mardi, le 1er Mai, le 1er Novembre et le 25 Décembre.',
                'translation_domain' => 'forms'

            ))
            ->add('ticketsQuantity', IntegerType::class, array(
                'label' => 'Nombre de visiteurs',
                'attr' => ['min' => '1', 'max' => '15'],
                'translation_domain' => 'forms'
            ))
            ->add('ticketType', ChoiceType::class, array(
                'label' => 'Type de billet',
                'help' => 'Le billet "Demi-Journée" n\'est valable qu\'à partir de 14h.',
                'choices' => array(
                    'Journée' => '1',
                    'Demi-Journée' => '2'
                ),
                'translation_domain' => 'forms'
            ))
            ->add('emailCustomer', RepeatedType::class, array(
                'type' => EmailType::class,
                'invalid_message' => 'Les adresses mails ne sont pas identiques.',
                'required' => true,
                'first_options'  => array('label' => 'Adresse mail de réception du/des billet(s)'),
                'second_options' => array('label' => 'Confirmer l\'adresse mail'),
                'translation_domain' => 'forms'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => OrderCustomer::class,
            'validation_groups' =>  new GroupSequence(['OrderCustomer', 'booking', 'bookingBis'])
        ));
    }
}
