<?php

namespace App\Form\Type;

use App\Entity\OrderCustomer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;





class BeneficiariesListType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ticketsList', CollectionType::class, array(
                'entry_type' => BeneficiaryType::class,
                'label' => false
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => OrderCustomer::class,
            'validation_groups' => array('beneficiary')
        ));
    }
}
