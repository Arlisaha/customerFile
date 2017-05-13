<?php

namespace AppBundle\Form\CustomerCard;

use AppBundle\Entity\CustomerCard\Consultation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsultationTypeType extends AbstractType
{
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'choices'                   => array_flip(Consultation::$types),
			'choice_translation_domain' => true,
		]);
	}

	public function getParent()
	{
		return ChoiceType::class;
	}

	public function getName()
	{
		return 'consultation_type';
	}
}
