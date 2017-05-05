<?php

namespace AppBundle\Form\Animal;

use AppBundle\Entity\Animal\AbstractAnimal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OutsideTimeUnitType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
		$resolver->setDefaults([
			'choices' => AbstractAnimal::$outsideTimeUnits
		]);
    }

    public function getParent()
	{
		return ChoiceType::class;
	}
}
