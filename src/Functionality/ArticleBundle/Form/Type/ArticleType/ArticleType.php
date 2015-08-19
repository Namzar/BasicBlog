<?php

namespace Functionality\ArticleBundle\Form\Type\ArticleType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $readOnly = $options['read_only'];
        $builder
            ->add('name', 'text', array(
                'read_only' => $readOnly,
                ))
            ->add('content', 'textarea', array(
                'read_only' => $readOnly,
                ))
            ->add('slug', 'text', array(
                'read_only' => $readOnly,
                ))
            ->add('portal','checkbox', array(
                'required'  => false,
                'read_only' => $readOnly,
                'disabled' => $readOnly,
                ))
        ;
        if (!$readOnly){
            $builder->add('save', 'submit');
        }
            
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Functionality\ArticleBundle\Entity\Article',
            'read_only' => false,
        ));
    }

    public function getName()
    {
        return 'Article';
    }
}
