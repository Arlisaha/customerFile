<?php

namespace AppBundle\Form\Animal;

use AppBundle\Entity\Animal\Dog;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DogType extends AbstractAnimalType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('breed', EntityType::class, [
				'class'         => 'AppBundle\Entity\Animal\DogBreed',
				'expanded'      => false,
				'multiple'      => false,
				'query_builder' => function (EntityRepository $er) {
					return $er->createQueryBuilder('d')
						->orderBy('d.label', 'ASC');
				},
			]);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => Dog::class,
		]);
	}
}