<?php

namespace Functionality\NavbarBundle\Form\Type\NavbarLinkType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NavbarLinkType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$readOnly = $options['readOnly'];
		$builder
			->add('name', 'text', array('read_only' => $readOnly))
			->add('weight', 'integer', array('read_only' => $readOnly))
			->add('enable','checkbox', array(
				'required'  => false,
				'read_only' => $readOnly,
				))
			->add('linkEnable','checkbox', array(
				'required'  => false,
				'read_only' => $readOnly,
				))
			->add('navbar', 'entity', array(
	            'class' => 'FunctionalityNavbarBundle:Navbar',
	            'property' => 'id',
	            'required'  => false
				'read_only' => $readOnly,
	            ))
			->add('parent', 'entity', array(
	            'class' => 'FunctionalityNavbarBundle:NavbarLink',
	            'property' => 'id',
	            'required'  => false,
				'read_only' => $readOnly,
	            ))
			->add('navbarLinkRef', new NavbarLinkNavbarLinkRefType(), array(
				'options' => $options,
	            'required'  => false,
				'read_only' => $readOnly,
	            ))
			->add('childs', 'collection', array(
				'type'=> new NavbarLinkChildType(),
				'options' => $options,
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
        'data_class' => 'Functionality\NavbarBundle\Entity\NavbarLink',
        'readOnly' => false,
    ));
	}

	public function getName()
	{
		return 'NavbarLink';
	}
}