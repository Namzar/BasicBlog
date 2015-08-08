<?php

namespace Functionality\NavbarBundle\Form\Type\NavbarType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NavbarNavbarLinkType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$readOnly = $options['read_only'];
		if (!$readOnly) {
			$attr = array('data-prototype' => 'self-referencing');
		} else {
			$attr = array();
		}
		
		$builder
			->add('name', 'text', array(
				'read_only' => $readOnly,
				))
			->add('weight', 'integer', array(
				'read_only' => $readOnly,
				))
			->add('enable','checkbox', array(
				'required'  => false,
				'read_only' => $readOnly,
				'disabled' => $readOnly, 
			))
			->add('linkEnable','checkbox', array(
				'required'  => false,
				'read_only' => $readOnly,
				'disabled' => $readOnly, 
			))
			->add('navbarLinkRef', new NavbarNavbarLinkRefType(), array(
            	'required'  => false,
				'read_only' => $readOnly,
        	))
			->add('childs', 'collection', array(
				'type'=> new NavbarNavbarLinkType(),
				'options' => array('read_only' => $readOnly),
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
				'prototype' => false,
				'attr' => $attr,
				'read_only' => $readOnly,
			))
		;
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
    $resolver->setDefaults(array(
        'data_class' => 'Functionality\NavbarBundle\Entity\NavbarLink',
        'read_only' => false,
    ));
	}

	public function getName()
	{
		return 'Navbar_NavbarLink';
	}
}