<?php

namespace App\Form\Type;

use App\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class BeneficiaryType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, array(
                'label' => 'Prénom',
                'attr' => ['maxlength' => '35'],
                'translation_domain' => 'forms',
            ))
            ->add('lastName', TextType::class, array(
                'label' => 'Nom',
                'attr' => ['maxlength' => '45'],
                'translation_domain' => 'forms'
            ))
            ->add('dateOfBirth', BirthdayType::class, array(
                'label' => 'Date de naissance',
                'format' => 'dd MMM yyyy',
                'placeholder' => array(
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                ),
                'translation_domain' => 'forms'
            ))
            ->add('country', CountryType::class, array(
                'label' => 'Pays',
                'placeholder' => 'Sélectionner un pays',
                'translation_domain' => 'forms'
            ))
            ->add('reduction', CheckboxType::class, array(
                'label' => 'Réduction',
                'required' => false,
                'help' => 'Sur présentation d\'un justificatif à l\'entrée du musée',
                'translation_domain' => 'forms'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Ticket::class
        ));
    }
}
