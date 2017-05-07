<?php

namespace AppBundle\Form\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class TelType extends AbstractType
{
	public function getParent()
	{
		return NumberType::class;
	}

	public function getName()
	{
		return 'tel';
	}
}
