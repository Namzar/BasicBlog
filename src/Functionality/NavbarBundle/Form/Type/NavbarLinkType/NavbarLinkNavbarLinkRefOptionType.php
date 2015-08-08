<?php

namespace Functionality\NavbarBundle\Form\Type\NavbarLinkType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NavbarLinkNavbarLinkRefOptionType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$readOnly = $options['readOnly'];
		$builder
			->add('optionKey', 'text', array('read_only' => $readOnly))
			->add('optionValue', 'text', array('read_only' => $readOnly))
		;
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
    $resolver->setDefaults(array(
        'data_class' => 'Functionality\NavbarBundle\Entity\NavbarLinkRefOption',
        'readOnly' => false,
    ));
	}

	public function getName()
	{
		return 'NavbarLink_NavbarLinkRef_NavbarLinkRefOption';
	}
}