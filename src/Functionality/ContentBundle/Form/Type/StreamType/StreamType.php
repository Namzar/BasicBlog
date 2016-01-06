<?php

namespace Functionality\ContentBundle\Form\Type\StreamType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StreamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $readOnly = $options['read_only'];
        $builder
            ->add('name', 'text', array(
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
            'data_class' => 'Functionality\ContentBundle\Entity\Stream',
            'read_only' => false,
        ));
    }

    public function getName()
    {
        return 'Stream';
    }
}
