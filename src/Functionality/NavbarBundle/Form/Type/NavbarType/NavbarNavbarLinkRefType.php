<?php

namespace Functionality\NavbarBundle\Form\Type\NavbarType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NavbarNavbarLinkRefType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$readOnly = $options['read_only'];
		$builder
			->add('routePath', 'text', array(
				'read_only' => $readOnly,
				))
			->add('navbarLinkRefOptions', 'collection', array(
			'type'=> new NavbarNavbarLinkRefOptionType(),
			'options' => array('read_only' => $readOnly),
			'allow_add' => true,
			'allow_delete' => true,
			'by_reference' => false,
			'prototype' => !$readOnly,
			'read_only' => $readOnly,
			))
		;
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
    $resolver->setDefaults(array(
        'data_class' => 'Functionality\NavbarBundle\Entity\NavbarLinkRef',
        'read_only' => false,
    ));
	}

	public function getName()
	{
		return 'Navbar_NavbarLink_NavbarLinkRef';
	}
}