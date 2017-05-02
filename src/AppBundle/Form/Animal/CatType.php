<?php

namespace AppBundle\Form\Animal;

use AppBundle\Entity\Animal\Cat;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CatType extends AbstractAnimalType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('breed', EntityType::class, [
				'class'         => 'AppBundle\Entity\Animal\CatBreed',
				'expanded'      => false,
				'multiple'      => false,
				'query_builder' => function (EntityRepository $er) {
					return $er->createQueryBuilder('c')
						->orderBy('c.label', 'ASC');
				},
			]);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => Cat::class,
		]);
	}
}