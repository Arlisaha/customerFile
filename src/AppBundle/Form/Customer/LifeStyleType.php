<?php

namespace AppBundle\Form\Customer;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LifeStyleType extends AbstractType
{
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'class'                     => 'AppBundle\Entity\Customer\LifeStyle',
			'expanded'                  => true,
			'multiple'                  => true,
			'choice_translation_domain' => null,
			'query_builder'             => function (EntityRepository $er) {
				return $er->createQueryBuilder('ls')
					->orderBy('ls.label', 'ASC');
			},
		]);
	}

	public function getParent()
	{
		return EntityType::class;
	}
}
