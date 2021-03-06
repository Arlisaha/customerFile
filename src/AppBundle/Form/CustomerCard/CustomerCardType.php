<?php

namespace AppBundle\Form\CustomerCard;

use AppBundle\Entity\CustomerCard\CustomerCard;
use AppBundle\Form\Customer\CustomerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerCardType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('customer', CustomerType::class, [
				'required' => true,
			])
			->add('consultations', CollectionType::class, [
				'entry_type'     => ConsultationType::class,
				'allow_add'      => true,
				'allow_delete'   => true,
				'prototype'      => true,
				'prototype_name' => '__consultation__',
				'by_reference'   => false,
				'required'       => false,
				'entry_options'  => [
					'customer_card_id' => $builder->getData()->getId(),
				],
			])
			->add('comments', TextareaType::class, [
				'required' => false,
			]);
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => CustomerCard::class,
		]);
	}
	
	public function getName()
	{
		return 'customer_card';
	}
}
