<?php

namespace AppBundle\Form\CustomerCard;

use AppBundle\Entity\CustomerCard\CustomerCard;
use AppBundle\Form\Customer\CustomerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerCardType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('customer', CustomerType::class, [])
			->add('consultations', CollectionType::class, [
				'entry_type'     => ConsultationType::class,
				'allow_add'      => true,
				'allow_delete'   => true,
				'prototype'      => true,
				'prototype_name' => '__consultation__',
				'by_reference'   => false,
			])
			->add('comments', TextareaType::class, [])
			->add('submit', SubmitType::class, []);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => CustomerCard::class,
		]);
	}
}
