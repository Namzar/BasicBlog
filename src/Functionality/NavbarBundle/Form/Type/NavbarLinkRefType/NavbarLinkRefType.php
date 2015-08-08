<?php

namespace Functionality\NavbarBundle\Form\Type\NavbarLinkRefType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NavbarLinkRefType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$readOnly = $options['readOnly'];
		$builder
			->add('routePath', 'text', array('read_only' => $readOnly));
			->add('navbarLinks', 'collection', array(
				'type' => 'entity',
				'options' => array(
					'class' => 'FunctionalityNavbarBundle:NavbarLink',
	            	'property' => 'id',
					),
	            'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
	            'required'  => false,
				'prototype' => !$readOnly,
				'read_only' => $readOnly,
            ))
			->add('navbarLinkRefOptions', 'collection', array(
				'type'=> new NavbarLinkRefNavbarLinkRefOptionType(),
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
        'data_class' => 'Functionality\NavbarBundle\Entity\NavbarLinkRef',
        'readOnly' => false,
    ));
	}

	public function getName()
	{
		return 'NavbarLinkRef';
	}
}