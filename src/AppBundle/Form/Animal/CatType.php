<?php

namespace AppBundle\Form\Animal;

use AppBundle\Entity\Animal\Cat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CatType extends AnimalType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('breed', EntityType::class, [
				'class' => 'AppBundle\Entity\Animal\CatBreed',
			]);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => Cat::class,
		]);
	}
}