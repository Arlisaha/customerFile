<?php

namespace AppBundle\Form\Animal;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BreedType extends AbstractType
{
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'class'                     => 'AppBundle\Entity\Animal\AbstractBreed',
			'expanded'                  => false,
			'multiple'                  => false,
			'choice_translation_domain' => null,
			'query_builder'             => function (EntityRepository $er) {
				return $er->createQueryBuilder('t')
					->orderBy('t.label', 'ASC');
			},
		]);
	}

	public function getParent()
	{
		return EntityType::class;
	}

	public function getName()
	{
		return 'breed';
	}
}
