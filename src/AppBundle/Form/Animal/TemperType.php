<?php

namespace AppBundle\Form\Animal;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\ChoiceList\View\ChoiceView;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TemperType extends AbstractType
{
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'class'                     => 'AppBundle\Entity\Animal\Temper',
			'expanded'                  => true,
			'multiple'                  => true,
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
}
