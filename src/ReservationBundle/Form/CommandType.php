<?php

namespace ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',   DateType::class,array(
                'label'     => 'Date de reservation',
                'format'    =>'dd/MM/yyyy',
                'widget'    =>'single_text',
                'html5'     => false
            ))
            ->add('type',   ChoiceType::class,array(
                'label'     => 'Type de billet',
                'choices' => array(
                    'Journée' => true,
                    'Demi-journée (14h00)' => false
                )
            ))
            ->add('email',  EmailType::class,array(
                'label'     => 'Adresse Email'
            ))
            ->add('tickets', CollectionType::class, array(
                'entry_type'   => TicketType::class,
                'allow_add'    => true,
                'allow_delete' => true
            ))
            ->add('save',   SubmitType::class,array(
                'label'     => 'Réserver'
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ReservationBundle\Entity\Command'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'reservationbundle_command';
    }


}
