<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class OrderType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bookingDate', DateType::class, array(
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker']
            ))
            ->add('ticketsQuantity', IntegerType::class, array(
            ))
            ->add('ticketType', ChoiceType::class, array(
                'choices' => array(
                    'Full Day' => '1',
                    'Half-day' => '2'
                )
            ))
            ->add('emailCustomer', RepeatedType::class, array(
                'type' => EmailType::class,
                'invalid_message' => 'The email fields must match.',
                'required' => true,
                'first_options'  => array('label' => 'Email'),
                'second_options' => array('label' => 'Repeat Email'),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Order::class,
            'validation_groups' => array('booking')
        ));
    }
}