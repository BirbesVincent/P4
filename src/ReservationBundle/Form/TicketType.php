<?php

namespace ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class TicketType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reduced', CheckboxType::class, array(
                'label' => 'Tarif Réduit ?',
                'required' => false,
            ))
            ->add('firstName',  TextType::class, array(
                'label'         => 'Prénom'
            ))
            ->add('lastName',   TextType::class, array(
                'label'         => 'Nom'
            ))
            ->add('birthday',   DateTimeType::class,array(
                'label'         => 'Date de naissance *',
                'required'      => true,
                'format'    =>'dd/MM/yyyy',
                'widget'    =>'single_text',
                'html5'     => false
            ))
            ->add('country',    TextType::class, array(
                'label'         => 'Pays'
            ));

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ReservationBundle\Entity\Ticket'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'reservationbundle_ticket';
    }


}
