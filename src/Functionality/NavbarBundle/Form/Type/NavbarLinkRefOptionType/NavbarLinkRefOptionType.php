<?php

namespace Functionality\NavbarBundle\Form\Type\NavbarLinkRefOptionType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NavbarLinkRefOptionType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$readOnly = $options['readOnly'];
		$builder
			->add('optionKey', 'text', array('read_only' => $readOnly))
			->add('optionValue', 'text', array('read_only' => $readOnly))
			->add('navbarLinkRef', 'entity', array(
	            'class' => 'FunctionalityNavbarBundle:NavbarLinkRef',
	            'property' => 'id',
	            'required'  => false,
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
        'data_class' => 'Functionality\NavbarBundle\Entity\NavbarLinkRefOption',
    ));
	}

	public function getName()
	{
		return 'NavbarLinkRefOption';
	}
}