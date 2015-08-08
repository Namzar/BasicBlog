<?php

namespace Functionality\NavbarBundle\Form\Type\NavbarType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NavbarNavbarLinkRefOptionType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$readOnly = $options['read_only'];
		$builder->add('optionKey', 'text', array(
			'read_only' => $readOnly,
			));
		$builder->add('optionValue', 'text', array(
			'read_only' => $readOnly,
			));
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
    $resolver->setDefaults(array(
        'data_class' => 'Functionality\NavbarBundle\Entity\NavbarLinkRefOption',
        'read_only' => false,
    ));
	}

	public function getName()
	{
		return 'Navbar_NavbarLink_NavbarLinkRef_NavbarLinkRefOption';
	}
}