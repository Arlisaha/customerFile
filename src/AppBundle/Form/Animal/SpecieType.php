<?php

namespace AppBundle\Form\Animal;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecieType extends AbstractType
{
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'mapped'                    => false,
			'choice_translation_domain' => true,
			'choices'                   => [
				'entity.customer.specie.cat' => 'cat',
				'entity.customer.specie.dog' => 'dog',
			],
		]);
	}
	
	public function getParent()
	{
		return ChoiceType::class;
	}
	
	public function getName()
	{
		return 'specie';
	}
}