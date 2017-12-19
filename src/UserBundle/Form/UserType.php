<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName',  TextType::class, array(
                'label'         => 'Prénom'
            ))
            ->add('lastName',   TextType::class, array(
                'label'         => 'Nom'
            ))
            ->add('birthday',   DateTimeType::class,array(
                'label'         => 'Date de naissance *',
                'required'      => true,
                'widget'        =>'single_text',
                'placeholder'   =>'jj/mm/aaaa',
                'format'        =>'dd/MM/yyyy'))
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
            'data_class' => 'UserBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_user';
    }


}
