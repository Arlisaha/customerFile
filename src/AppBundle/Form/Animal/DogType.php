<?php

namespace AppBundle\Form\Animal;

use AppBundle\Entity\Animal\Dog;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DogType extends AnimalType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('breed', BreedType::class, [
				'class' => 'AppBundle\Entity\Animal\DogBreed',
			]);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => Dog::class,
		]);
	}
}