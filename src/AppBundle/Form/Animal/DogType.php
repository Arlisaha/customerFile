<?php

namespace AppBundle\Form\Animal;

use AppBundle\Entity\Animal\Dog;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DogType extends AnimalType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		parent::buildForm($builder, $options);
		$builder
			->add('breed', BreedType::class, [
				'class'    => 'AppBundle\Entity\Animal\DogBreed',
				'required' => true,
			])
			->add('dailyWalkTime', TimeType::class, [
				'html5'    => true,
				'widget'   => 'single_text',
				'input'    => 'string',
				'required' => false,
			]);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => Dog::class,
		]);
	}
}