<?php

namespace AppBundle\Form\Customer;

use AppBundle\Entity\Customer\Owner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GenderType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
		$resolver->setDefaults([
			'choices' => Owner::$genders
		]);
    }

    public function getParent()
	{
		return ChoiceType::class;
	}
}
