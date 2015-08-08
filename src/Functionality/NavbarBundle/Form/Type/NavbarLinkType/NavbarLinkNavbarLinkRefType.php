<?php

namespace Functionality\NavbarBundle\Form\Type\NavbarLinkType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NavbarLinkNavbarLinkRefType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$readOnly = $options['readOnly'];
		$builder
			->add('routePath', 'text', array('read_only' => $readOnly));
			->add('navbarLinkRefOptions', 'collection', array(
				'type'=> new NavbarLinkNavbarLinkRefOptionType(),
				'options' => $options,
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
				'read_only' => $readOnly,
			))
		;
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
		return 'NavbarLink_NavbarLinkRef';
	}
}