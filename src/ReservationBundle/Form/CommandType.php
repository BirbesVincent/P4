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
                'label'     => 'Date de visite',
                'format'    =>'dd/MM/yyyy',
                'widget'    =>'single_text',
                'attr' => [
                    'readonly'       => true],
                'html5'     => false
            ))
            ->add('type',   ChoiceType::class,array(
                'label'     => 'Type de billet',
                'choices' => array(
                    'Demi-journée (14h00)' => false,
                    'Journée' => true
                )
            ))
            ->add('email',  EmailType::class,array(
                'label'     => 'Adresse Email'
            ))
            ->add('tickets', CollectionType::class, array(
                'label'        => false,
                'entry_type'   => TicketType::class,
                'allow_add'    => true,
                'allow_delete' => true
            ))
            ->add('save',   SubmitType::class,array(
                'label'     => 'Réserver',
                'attr' => [
                    'class'    => 'btn btn-dark']
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
