<?php

namespace Functionality\NavbarBundle\Form\Type\NavbarType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NavbarType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$readOnly = $options['read_only'];
		$builder
			->add('name', 'text', array(
				'read_only' => $readOnly, 
				))
			->add('navbarLinks', 'collection', array(
				'type' => new NavbarNavbarLinkType(),
				'options' => array('read_only' => $readOnly),
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
	        'data_class' => 'Functionality\NavbarBundle\Entity\Navbar',
            'read_only' => false,
	    ));
	}

	public function getName()
	{
		return 'Navbar';
	}
}