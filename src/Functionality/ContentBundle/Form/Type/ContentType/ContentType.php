<?php

namespace Functionality\ContentBundle\Form\Type\ContentType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $readOnly = $options['read_only'];
        $builder
            ->add('name', 'text', array(
                'read_only' => $readOnly,
                ))
            ->add('date', 'date', array(
                'read_only' => $readOnly,
                ))
            ->add('content', 'textarea', array(
                'read_only' => $readOnly,
                ))
            ->add('slug', 'text', array(
                'read_only' => $readOnly,
                ))
            ->add('published','checkbox', array(
                'required'  => false,
                'read_only' => $readOnly,
                'disabled' => $readOnly,
                ))
            ->add('streams', 'collection', array(
                'type' => 'entity',
                'options' => array(
                    'read_only' => $readOnly,
                    'class' => 'FunctionalityContentBundle:Stream',
                    'property' => 'name',
                    ),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => !$readOnly,
                'read_only' => $readOnly,
                ))
            ->add('applications', 'collection', array(
                'type' => 'entity',
                'options' => array(
                    'read_only' => $readOnly,
                    'class' => 'AppBundle:Application',
                    'property' => 'name',
                    ),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => !$readOnly,
                'read_only' => $readOnly,
                ))
        ;
        if (!$readOnly){
            $builder->add('save', 'submit');
        }
            
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Functionality\ContentBundle\Entity\Content',
            'read_only' => false,
        ));
    }

    public function getName()
    {
        return 'Content';
    }
}
